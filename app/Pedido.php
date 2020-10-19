<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pedido';

    protected $primaryKey = 'id_pedido';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_pagado', 'fecha_compra', 'nombre_comprador', 'direccion_comprador',
        'fecha_entrega', 'codigo_pedido', 'estatus', 'id_forma_pago', 'id_usuario'
    ];
}
