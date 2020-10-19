<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_clasificacion';

    protected $primaryKey = 'id_clasificacion';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion', 'imagen'
    ];

    public function users() {
      return $this->belongsToMany(User::class, 'usuario_clasificacion', 'id_clasificacion', 'id_usuario');
    }

}
