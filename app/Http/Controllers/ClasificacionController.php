<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Clasificacion;

class ClasificacionController extends Controller
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
            $clasificaciones = Clasificacion::all();
            return view('clasificacion.index', ['clasificaciones' => $clasificaciones]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
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
            return view('clasificacion.create');
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/clasificacion');
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
              'nombre' => ['required', 'string', 'max:255', 'unique:tb_clasificacion'],
              'descripcion' => ['required', 'string', 'max:255'],
              'imagen' => ['required', 'image', 'mimes:jpeg,jpg,bmp,png'],
            ],[
              'anio.required' => 'El campo año es obligatorio'
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/clasificacion/create')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $clasificacion = new Clasificacion();

              $clasificacion->nombre = $request->input('nombre');
              $clasificacion->descripcion = $request->input('descripcion');
              if($request->hasFile('imagen')){
                 $clasificacion->imagen = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('imagen')->storePublicly('clasificacion', 's3');
              }
              $clasificacion->estatus = 1;

              $clasificacion->save();

              session()->flash('create_success', 'Se guardo exitosamente');

              return redirect('/clasificacion');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/clasificacion');
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
            return view('clasificacion.show', ['clasificacion' => Clasificacion::findOrFail($id)]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
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
            return view('clasificacion.edit', ['clasificacion' => Clasificacion::findOrFail($id)]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/clasificacion');
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
            $clasificacion = Clasificacion::findOrFail($id);
            $validator = Validator::make($request->all(), [
              'nombre' => ['required', 'string', 'max:255', 'unique:App\Clasificacion,nombre,'.$clasificacion->id_clasificacion],
              'descripcion' => ['required', 'string', 'max:255'],
              'imagen' => ['image', 'mimes:jpeg,jpg,bmp,png'],
            ],[
              'anio.required' => 'El campo año es obligatorio'
            ]);

              //Se valida el formulario
              if($validator->fails()){
                  //Se retorna el objeto a la vista con errores
                  return redirect('/clasificacion/'.$id.'/edit')->withErrors($validator)->withInput();
              } else {
                //Se actualiza contraseña
                $clasificacion = Clasificacion::findOrFail($id);

                $clasificacion->nombre = $request->input('nombre');
                $clasificacion->descripcion = $request->input('descripcion');
                if($request->hasFile('imagen')){
                  $nomimg = basename($clasificacion->imagen);
                  \Storage::disk('s3')->delete('clasificacion', 'clasificacion/'.$nomimg);

                  $clasificacion->imagen = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('imagen')->storePublicly('clasificacion', 's3');
                }

                $clasificacion->update();

                session()->flash('update_success', 'Se actualizo exitosamente');

                return redirect('/clasificacion');
              }
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/clasificacion');
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
            $clasificacion = Clasificacion::findOrFail($id);

            $exist = \DB::select("select * from clasificacion_categoria pc where pc.id_clasificacion = :id", ['id' => $clasificacion->id_clasificacion]);
            $exist2 = \DB::select("select * from usuario_clasificacion um where um.id_clasificacion = :id", ['id' => $clasificacion->id_clasificacion]);

            if (!(empty($exist))) {
              $m = $clasificacion->nombre;
              $countp = 0;
              $message = "";

              foreach ($exist as $e) {
                $countp = $countp + 1;
              }

              if ($countp > 1) {
                $message = "La clasificación " . $m . " no puede ser eliminada, porque esta siendo usada por " . $countp . " productos.";
              } else {
                $message = "La clasificación " . $m . " no puede ser eliminada, porque esta siendo usada por " . $countp . " producto.";
              }

              session()->flash('error_clasificacion_fk', $message);
            } elseif (!(empty($exist2))) {
              $m = $clasificacion->nombre;
              $countp = 0;
              $message = "";

              foreach ($exist2 as $e) {
                $countp = $countp + 1;
              }

              if ($countp > 1) {
                $message = "La clasificación " . $m . " no puede ser eliminada, porque esta siendo usada por " . $countp . " vendedores.";
              } else {
                $message = "La clasificación " . $m . " no puede ser eliminada, porque esta siendo usada por " . $countp . " vendedor.";
              }

              session()->flash('error_clasificacion_2_fk', $message);
            } else {
              $clasificacion->delete();

              $nomimg = basename($clasificacion->imagen);

              \Storage::disk('s3')->delete('clasificacion', 'clasificacion/'.$nomimg);

              session()->flash('delete_success', 'Se elimino exitosamente');
            }

            return redirect('/clasificacion');
          } catch (\Exception $ex) {
            session()->flash('error_exception_clasificacion', $ex->getMessage());
            return redirect('/clasificacion');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/clasificacion');
        } else {
          return redirect('/home');
        }
    }
}
