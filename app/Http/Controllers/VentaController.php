<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;

class VentaController extends Controller
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
            $ventas = \DB::select("select pr.nombre as nombre_producto, pr.precio_vendedor,
                                          pr.imagen, pr.id_producto, pe.id_pedido, pp.cantidad_producto,
                                          tc.nombre as clasificacion
                                   from pedido pe inner join forma_pago fp on pe.id_forma_pago = fp.id_forma_pago
			                                            inner join users u on pe.id_usuario = u.id
			                                            inner join producto_pedido pp on pe.id_pedido = pp.id_pedido
                                                  inner join producto pr on pp.id_producto = pr.id_producto
                                                  inner join clasificacion_categoria cc on cc.id_producto = pr.id_producto
                                                  inner join categoria ct on cc.id_categoria = ct.id_categoria
                                                  inner join tb_clasificacion tc on cc.id_clasificacion = tc.id_clasificacion;");
            return view('ventas.index', ['ventas' => $ventas]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_ventas', $ex->getMessage());
            return redirect('/ventas');
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
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        //
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        //
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verDetalle($pedido, $producto)
    {
        if (Auth::user()->role == '1') {
          try {
            $venta = \DB::select("select pr.nombre as nombre_producto, pr.precio_vendedor, pr.descripcion, pr.marca,
	                                       pr.id_producto, pe.total_pagado, pe.id_pedido, pe.fecha_compra, pe.fecha_entrega,
	                                       pe.codigo_pedido, pp.cantidad_producto, tc.nombre as clasificacion, ct.nombre as categoria,
	                                       fp.nombre as forma_pago, concat(u.name, ' ', u.lastname) as nombre_vendedor
                                  from pedido pe inner join forma_pago fp on pe.id_forma_pago = fp.id_forma_pago
			                                           inner join users u on pe.id_usuario = u.id
			                                           inner join producto_pedido pp on pe.id_pedido = pp.id_pedido
			                                           inner join producto pr on pp.id_producto = pr.id_producto
			                                           inner join clasificacion_categoria cc on cc.id_producto = pr.id_producto
			                                           inner join categoria ct on cc.id_categoria = ct.id_categoria
			                                           inner join tb_clasificacion tc on cc.id_clasificacion = tc.id_clasificacion
                                  where pe.id_pedido = :id and pr.id_producto = :id2;", ['id' => $pedido, 'id2' => $producto]);
            return view('ventas.detalle', ['venta' => $venta]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_ventas', $ex->getMessage());
            return redirect('/ventas');
          }
        } else {
          return redirect('/home');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function historico()
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1') {
          try {
            $ventas = \DB::select("select pe.fecha_compra, pr.nombre as nombre_producto,
                                          tc.nombre as clasificacion, pp.cantidad_producto, pr.precio_vendedor
                                   from pedido pe inner join forma_pago fp on pe.id_forma_pago = fp.id_forma_pago
			                                            inner join users u on pe.id_usuario = u.id
			                                            inner join producto_pedido pp on pe.id_pedido = pp.id_pedido
			                                            inner join producto pr on pp.id_producto = pr.id_producto
			                                            inner join clasificacion_categoria cc on cc.id_producto = pr.id_producto
			                                            inner join categoria ct on cc.id_categoria = ct.id_categoria
			                                            inner join tb_clasificacion tc on cc.id_clasificacion = tc.id_clasificacion
                                   order by pe.fecha_compra asc;");
            return view('ventas.historico', ['ventas' => $ventas]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_ventas', $ex->getMessage());
            return redirect('/ventas');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/ventas');
        } else {
          return redirect('/home');
        }
    }

    public function export(Request $request)
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            $validator = Validator::make($request->all(), [
              'email' => ['required', 'string', 'email'],
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                $error = $validator->errors()->get('email');
                $err = "El correo no se ha enviado, debido a que: " . $error[0];
                session()->flash('send_mail_error', $err);
                return redirect('/ventas')->withErrors($validator)->withInput();
            } else {
              $email = $request->input('email');
              $excel = Excel::store(new VentasExport, 'ventas.xlsx', 'public');
              \Mail::send('email.ventas', compact("excel"), function ($mail) use ($email) {
                  $mail->subject('Reporte de Ventas');
                  $mail->to($email);
                  $mail->attach(\Storage::disk('public')->path('ventas.xlsx'));
              });
              \Storage::disk('public')->delete('ventas.xlsx');

              session()->flash('send_mail_success', 'Se envio el reporte de ventas exitosamente');

              return redirect('/ventas');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_ventas', $ex->getMessage());
            return redirect('/ventas');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/ventas');
        } else {
          return redirect('/home');
        }
    }
}
