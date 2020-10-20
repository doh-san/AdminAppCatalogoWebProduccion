<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Imagen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producto_imagen';

    protected $primaryKey = 'id_producto_imagen';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_producto', 'ruta', 'principal', 'fecha_registro'
    ];

    public function producto() {
      return $this->belongsTo(Producto::class, 'id_producto');
    }
}
