<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

    protected $table = 'persona';

    protected $fillable = [ 
        'pers_nombre', 
        'pers_apellido', 
        'tido_id',
        'pers_dni',
        'pers_fecha_nac',
        'pers_telefono',
        'pers_correo',
        'prof_id', 
        'pers_perfil',
        'pers_exp_laboral', 
    ];
}
