<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calificacion_curso extends Model
{
    protected $table = 'calificacion_curso';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    protected $fillable = [ 
        'idcurso',
        'idusuario',
        'pregunta1',
        'pregunta2',
        'pregunta3',
        'pregunta4',
        'pregunta5',
        'pregunta6',
        'pregunta8',
        'pregunta9',
        'pregunta10',
        'promedioCalificacion',
    ];
}
