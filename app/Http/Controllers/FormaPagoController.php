<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Forma_Pago;

class FormaPagoController extends Controller
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
            $formas = Forma_Pago::all();
            return view('forma_pago.index', ['formas' => $formas]);
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
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
            return view('forma_pago.create');
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/forma_pago');
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
              'nombre' => ['required', 'string', 'max:255', 'unique:forma_pago'],
              'descripcion' => ['required', 'string', 'max:255'],
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/forma_pago/create')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $forma = new Forma_Pago();

              $forma->nombre = request('nombre');
              $forma->descripcion = request('descripcion');
              $forma->estatus = 1;

              $forma->save();

              session()->flash('create_success', 'Se guardo exitosamente');

              return redirect('/forma_pago');
            }
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/forma_pago');
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
            return view('forma_pago.show', ['forma' => Forma_Pago::findOrFail($id)]);
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
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
            return view('forma_pago.edit', ['forma' => Forma_Pago::findOrFail($id)]);
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/forma_pago');
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
            $forma = Forma_Pago::findOrFail($id);
            $validator = Validator::make($request->all(), [
              'nombre' => ['required', 'string', 'max:255', 'unique:App\Forma_Pago,nombre,'.$forma->id_forma_pago],
              'descripcion' => ['required', 'string', 'max:255'],
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/forma_pago/'.$id.'/edit')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $forma = Forma_Pago::findOrFail($id);

              $forma->nombre = request('nombre');
              $forma->descripcion = request('descripcion');

              $forma->update();

              session()->flash('update_success', 'Se actualizo exitosamente');

              return redirect('/forma_pago');
            }
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/forma_pago');
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
            $forma = Forma_Pago::findOrFail($id);

            $exist = \DB::select("select * from pedido p where p.id_forma_pago = :id", ['id' => $forma->id_forma_pago]);

            if (!(empty($exist))) {
              $fp = $forma->nombre;
              $countp = 0;
              $message = "";

              foreach ($exist as $e) {
                $countp = $countp + 1;
              }

              if ($countp > 1) {
                $message = "La forma de pago " . $fp . " no puede ser eliminada, porque esta siendo usada en " . $countp . " pedidos.";
              } else {
                $message = "La forma de pago " . $fp . " no puede ser eliminada, porque esta siendo usada en " . $countp . " pedido.";
              }

              session()->flash('error_forma_pago_fk', $message);
            } else {
              $forma->delete();

              session()->flash('delete_success', 'Se elimino exitosamente');
            }

            return redirect('/forma_pago');
          } catch (\Exception $ex) {
              session()->flash('error_exception_forma_pago', $ex->getMessage());
              return redirect('/forma_pago');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/forma_pago');
        } else {
          return redirect('/home');
        }
    }
}
