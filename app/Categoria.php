<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categoria';

    protected $primaryKey = 'id_categoria';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function productos() {
      return $this->belongsToMany(Categoria::class, 'clasificacion_categoria', 'id_categoria', 'id_producto');
    }
}
