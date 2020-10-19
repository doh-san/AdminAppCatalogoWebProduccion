<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdministradorController extends Controller
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
            $users = User::whereRaw('role = ?', [1])->get();
            return view('administradores.index', ['users' => $users]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
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
        if (Auth::user()->role == '1' && Auth::user()->level == '1') {
          try {
            return view('administradores.create');
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/administradores');
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
        if (Auth::user()->role == '1' && Auth::user()->level == '1') {
          try {
            $validator = Validator::make($request->all(), [
              'name' => ['required', 'string', 'max:255'],
              'lastname' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'gender' => ['required'],
              'telephone' => ['required', 'string', 'max:10', 'unique:users'],
              'level' => ['required'],
              'birthdate' => ['required', 'string'],
              'photography' => ['required', 'image', 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100', 'mimes:jpeg,jpg,bmp,png'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],[
              'photography.required' => 'El campo imagen de perfil es obligatorio',
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/administradores/create')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $admin = new User();

              $newDate = date("Y-m-d", strtotime(request('birthdate')));

              $admin->name = request('name');
              $admin->lastname = request('lastname');
              $admin->gender = request('gender');
              $admin->email = request('email');
              $admin->telephone = request('telephone');
              $admin->birthdate = $newDate;
              $admin->role = 1;
              $admin->level = request('level');
              if($request->hasFile('photography')){
                 $admin->photography = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('photography')->storePublicly('administradores', 's3');
              }
              $admin->password = Hash::make(request('password'));
              $admin->estatus = 1;

              $admin->save();

              session()->flash('create_success', 'Se guardo exitosamente');

              return redirect('/administradores');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/administradores');
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
            return view('administradores.show', ['user' => User::findOrFail($id)]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
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
            return view('administradores.edit', ['user' => User::findOrFail($id)]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/administradores');
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
            $admin = User::findOrFail($id);
            $validator = Validator::make($request->all(), [
              'name' => ['required', 'string', 'max:255'],
              'lastname' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:App\User,email,'.$admin->id],
              'gender' => ['required'],
              'telephone' => ['required', 'string', 'max:10', 'unique:App\User,telephone,'.$admin->id],
              'level' => ['required'],
              'birthdate' => ['required', 'string'],
              'photography' => ['image', 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100', 'mimes:jpeg,jpg,bmp,png'],
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/administradores/'.$id.'/edit')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $admin = User::findOrFail($id);

              $newDate = date("Y-m-d", strtotime(request('birthdate')));

              $admin->name = request('name');
              $admin->lastname = request('lastname');
              $admin->gender = request('gender');
              $admin->email = request('email');
              $admin->telephone = request('telephone');
              $admin->birthdate = $newDate;
              $admin->role = 1;
              $admin->level = request('level');
              if($request->hasFile('photography')){
                $nomimg = basename($admin->photography);
                \Storage::disk('s3')->delete('administradores', 'administradores/'.$nomimg);

                $admin->photography = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('photography')->storePublicly('administradores', 's3');
              }

              $admin->update();

              session()->flash('update_success', 'Se actualizo exitosamente');

              return redirect('/administradores');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/administradores');
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
            $admin = User::findOrFail($id);

            $admin->delete();

            $nomimg = basename($admin->photography);
            \Storage::disk('s3')->delete('administradores', 'administradores/'.$nomimg);

            session()->flash('delete_success', 'Se elimino exitosamente');

            return redirect('/administradores');
          } catch (\Exception $ex) {
            session()->flash('error_exception_administrador', $ex->getMessage());
            return redirect('/administradores');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/administradores');
        } else {
          return redirect('/home');
        }
    }
}
