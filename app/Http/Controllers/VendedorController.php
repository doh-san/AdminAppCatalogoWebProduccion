<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Clasificacion;

class VendedorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        if (Auth::user()->role == '1') {
          try {
            $vendedores = User::whereRaw('role = ?', [2])->get();
            return view('vendedores.index', ['vendedores' => $vendedores]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_vendedor', $ex->getMessage());
            return redirect('/vendedores');
          }
        } else {
          return redirect('/home');
        }
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            $clasificaciones = Clasificacion::all();
            return view('vendedores.create', ['clasificaciones' => $clasificaciones]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_vendedor', $ex->getMessage());
            return redirect('/vendedores');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/vendedores');
        } else {
          return redirect('/home');
        }
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
           try {
             $validator = Validator::make($request->all(), [
               'name' => ['required', 'string', 'max:255'],
               'lastname' => ['required', 'string', 'max:255'],
               'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
               'telephone' => ['required', 'string', 'max:10', 'unique:users'],
               'gender' => ['required'],
               'birthdate' => ['required', 'string'],
               'identification' => ['required', 'image', 'mimes:jpeg,jpg,bmp,png'],
               'voucher' => ['required', 'image', 'mimes:jpeg,jpg,bmp,png'],
               'photography' => ['required', 'image', 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100', 'mimes:jpeg,jpg,bmp,png'],
               'clasificaciones' => ['required'],
               'password' => ['required', 'string', 'min:8', 'confirmed'],
             ],[
               'identification.required' => 'El campo identificación es obligatorio',
               'voucher.required' => 'El campo comprobante de domicilio es obligatorio',
               'photography.required' => 'El campo imagen de perfil es obligatorio',
               'clasificaciones.required' => 'El campo clasificaciones asignadas es obligatorio'
             ]);

             //Se valida el formulario
             if($validator->fails()){
                 //Se retorna el objeto a la vista con errores
                 return redirect('/vendedores/create')->withErrors($validator)->withInput();
             } else {
               //Se actualiza contraseña
               $vendedor = new User();

               $newDate = date("Y-m-d", strtotime($request->input('birthdate')));

               $vendedor->name = $request->input('name');
               $vendedor->lastname = $request->input('lastname');
               $vendedor->gender = $request->input('gender');
               $vendedor->email = $request->input('email');
               $vendedor->telephone = $request->input('telephone');
               $vendedor->birthdate = $newDate;
               $vendedor->role = 2;
               $vendedor->points = 0;
               if($request->hasFile('identification')){
                  $vendedor->identification = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('identification')->storePublicly('vendedores', 's3');
               }
               if($request->hasFile('voucher')){
                  $vendedor->voucher = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('voucher')->storePublicly('vendedores', 's3');
               }
               if($request->hasFile('photography')){
                  $vendedor->photography = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('photography')->storePublicly('vendedores', 's3');
               }
               $vendedor->password = Hash::make($request->input('password'));
               $vendedor->estatus = 1;
               $clasificaciones = $request->input('clasificaciones');

               $vendedor->save();

               foreach ($clasificaciones as $clasificacion) {
                 $vendedor->clasificaciones()->attach($clasificacion);
               }

               session()->flash('create_success', 'Se guardo exitosamente');

               return redirect('/vendedores');
             }
           } catch (\Exception $ex) {
             session()->flash('error_exception_vendedor', $ex->getMessage());
             return redirect('/vendedores');
           }
         } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
           return redirect('/vendedores');
         } else {
           return redirect('/home');
         }
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         if (Auth::user()->role == '1') {
           try {
             return view('vendedores.show', ['vendedor' => User::findOrFail($id)]);
           } catch (\Exception $ex) {
             session()->flash('error_exception_vendedor', $ex->getMessage());
             return redirect('/vendedores');
           }
         } else {
           return redirect('/home');
         }
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         if (Auth::user()->role == '1' && Auth::user()->level == '1') {
           try {
             $clasificaciones = Clasificacion::all();
             return view('vendedores.edit', ['vendedor' => User::findOrFail($id), 'clasificaciones' => $clasificaciones]);
           } catch (\Exception $ex) {
             session()->flash('error_exception_vendedor', $ex->getMessage());
             return redirect('/vendedores');
           }
         } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
           return redirect('/vendedores');
         } else {
           return redirect('/home');
         }
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         if (Auth::user()->role == '1' && Auth::user()->level == '1') {
           try {
             $vendedor = User::findOrFail($id);

             $validator = Validator::make($request->all(), [
               'name' => ['required', 'string', 'max:255'],
               'lastname' => ['required', 'string', 'max:255'],
               'email' => ['required', 'string', 'email', 'max:255', 'unique:App\User,email,'.$vendedor->id],
               'telephone' => ['required', 'string', 'max:10', 'unique:App\User,telephone,'.$vendedor->id],
               'gender' => ['required'],
               'birthdate' => ['required', 'string'],
               'identification' => ['image', 'mimes:jpeg,jpg,bmp,png'],
               'voucher' => ['image', 'mimes:jpeg,jpg,bmp,png'],
               'photography' => ['image', 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100', 'mimes:jpeg,jpg,bmp,png'],
               'clasificaciones' => ['required'],
             ]);

             //Se valida el formulario
             if($validator->fails()){
                 //Se retorna el objeto a la vista con errores
                 return redirect('/vendedores/'.$id.'/edit')->withErrors($validator)->withInput();
             } else {
               //Se actualiza contraseña
               $vendedor = User::findOrFail($id);

               foreach ($vendedor->clasificaciones as $clasificacion) {
                 $vendedor->clasificaciones()->detach($clasificacion);
               }

               $newDate = date("Y-m-d", strtotime($request->input('birthdate')));

               $vendedor->name = $request->input('name');
               $vendedor->lastname = $request->input('lastname');
               $vendedor->gender = $request->input('gender');
               $vendedor->email = $request->input('email');
               $vendedor->telephone = $request->input('telephone');
               $vendedor->birthdate = $newDate;
               if($request->hasFile('identification')){
                 $nomimg1 = basename($vendedor->identification);
                 \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg1);

                 $vendedor->identification = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('identification')->storePublicly('vendedores', 's3');
               }
               if($request->hasFile('voucher')){
                 $nomimg2 = basename($vendedor->voucher);
                 \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg2);

                 $vendedor->voucher = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('voucher')->storePublicly('vendedores', 's3');
               }
               if($request->hasFile('photography')){
                 $nomimg3 = basename($vendedor->photography);
                 \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg3);

                 $vendedor->photography = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('photography')->storePublicly('vendedores', 's3');
               }
               $clasificaciones = $request->input('clasificaciones');

               $vendedor->update();

               foreach ($clasificaciones as $clasificacion) {
                 $vendedor->clasificaciones()->attach($clasificacion);
               }

               session()->flash('update_success', 'Se actualizo exitosamente');

               return redirect('/vendedores');
             }
           } catch (\Exception $ex) {
             session()->flash('error_exception_vendedor', $ex->getMessage());
             return redirect('/vendedores');
           }
         } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
           return redirect('/vendedores');
         } else {
           return redirect('/home');
         }
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         if (Auth::user()->role == '1' && Auth::user()->level == '1') {
           try {
             $vendedor = User::findOrFail($id);

             foreach ($vendedor->clasificaciones as $clasificacion) {
               $vendedor->clasificaciones()->detach($clasificacion);
             }

             $vendedor->delete();

             $nomimg1 = basename($vendedor->identification);
             $nomimg2 = basename($vendedor->voucher);
             $nomimg3 = basename($vendedor->photography);

             \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg1);
             \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg2);
             \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg3);

             session()->flash('delete_success', 'Se elimino exitosamente');

             return redirect('/vendedores');
           } catch (\Exception $ex) {
             session()->flash('error_exception_vendedor', $ex->getMessage());
             return redirect('/vendedores');
           }
         } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
           return redirect('/vendedores');
         } else {
           return redirect('/home');
         }
     }
}
