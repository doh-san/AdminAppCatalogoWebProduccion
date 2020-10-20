<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma_Pago extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forma_pago';

    protected $primaryKey = 'id_forma_pago';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion'
    ];
}
