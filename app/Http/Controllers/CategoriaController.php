<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Categoria;

class CategoriaController extends Controller
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
            $categorias = Categoria::all();
            return view('categorias.index', ['categorias' => $categorias]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
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
            return view('categorias.create');
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/categorias');
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
              'nombre' => ['required', 'string', 'max:255', 'unique:categoria'],
              'descripcion' => ['required', 'string', 'max:255'],
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/categorias/create')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $categoria = new Categoria();

              $categoria->nombre = request('nombre');
              $categoria->descripcion = request('descripcion');
              $categoria->estatus = 1;

              $categoria->save();

              session()->flash('create_success', 'Se guardo exitosamente');

              return redirect('/categorias');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/categorias');
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
            return view('categorias.show', ['categoria' => Categoria::findOrFail($id)]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
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
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            return view('categorias.edit', ['categoria' => Categoria::findOrFail($id)]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/categorias');
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
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            $categoria = Categoria::findOrFail($id);
            $validator = Validator::make($request->all(), [
              'nombre' => ['required', 'string', 'max:255', 'unique:App\Categoria,nombre,'.$categoria->id_categoria],
              'descripcion' => ['required', 'string', 'max:255'],
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/categorias/'.$id.'/edit')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $categoria = Categoria::findOrFail($id);

              $categoria->nombre = request('nombre');
              $categoria->descripcion = request('descripcion');

              $categoria->update();

              session()->flash('update_success', 'Se actualizo exitosamente');

              return redirect('/categorias');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/categorias');
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
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            $categoria = Categoria::findOrFail($id);

            $exist = \DB::select("select * from clasificacion_categoria cc where cc.id_categoria = :id", ['id' => $categoria->id_categoria]);

            if (!(empty($exist))) {
              $c = $categoria->nombre;
              $countp = 0;
              $message = "";

              foreach ($exist as $e) {
                $countp = $countp + 1;
              }

              if ($countp > 1) {
                $message = "La categoria " . $c . " no puede ser eliminada, porque esta siendo usada por " . $countp . " productos.";
              } else {
                $message = "La categoria " . $c . " no puede ser eliminada, porque esta siendo usada por " . $countp . " producto.";
              }

              session()->flash('error_categoria_fk', $message);
            } else {
              $categoria->delete();

              session()->flash('delete_success', 'Se elimino exitosamente');
            }

            return redirect('/categorias');
          } catch (\Exception $ex) {
            session()->flash('error_exception_categoria', $ex->getMessage());
            return redirect('/categorias');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/categorias');
        } else {
          return redirect('/home');
        }
    }
}
