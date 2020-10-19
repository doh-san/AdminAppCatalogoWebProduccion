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
        $ventas = \DB::select("select pr.nombre as nombre_producto, pr.precio_vendedor, pr.descripcion, pr.marca,
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
                               order by pe.codigo_pedido asc;");
        return view('excel.ventas', ['ventas' => $ventas]);
    }
}
