<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producto';

    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'cantidad', 'descuento', 'precio_venta', 'precio_vendedor',
        'puntos', 'imagen', 'descripcion'
    ];

    public function categorias() {
      return $this->belongsToMany(Categoria::class, 'clasificacion_categoria', 'id_producto', 'id_categoria')->withPivot('id_clasificacion_categoria','id_producto', 'id_categoria', 'id_clasificacion');
    }

    public function producto_imagen() {
      return $this->hasMany('App\Producto_Imagen', 'id_producto', 'id_producto');
    }
}
