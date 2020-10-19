<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VentasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $ventas = \DB::select("select pm.fecha, pr.nombre as nombre_producto, m.nombre as marca,
                                      pp.cantidad_producto, pr.precio_vendedor
                               from pedido pe inner join forma_pago fp on pe.id_forma_pago = fp.id_forma_pago
  			                                      inner join users u on pe.id_usuario = u.id
  			                                      inner join producto_pedido pp on pe.id_pedido = pp.id_pedido
                                              inner join producto pr on pp.id_producto = pr.id_producto
                                              inner join clasificacion_categoria pc on pc.id_producto = pr.id_producto
                                              inner join categoria ct on pc.id_categoria = ct.id_categoria
                                              inner join producto_marca pm on pc.id_producto_marca = pm.id_producto_marca
                                              inner join marca m on pm.id_marca = m.id_marca
                               order by pm.fecha asc;");
        return view('excel.ventas', ['ventas' => $ventas]);
    }
}
