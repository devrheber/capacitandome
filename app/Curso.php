<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model {
    protected $table = 'curso';

    protected $fillable = [
        'titulo',
        'portada', 
        'plan', 
        'hora_duracion',
        'precio',
        'idcategoria',
        'fecha_inicio',
        'fecha_final',
        'descripcion',
    ];
}
