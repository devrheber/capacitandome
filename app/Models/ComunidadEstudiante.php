<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComunidadEstudiante extends Model
{

    protected $table          = 'comunidad_estudiante';
    protected $primaryKey     = 'idcomunidad';
    protected $fillable       = ['idcurso', 'comunidad'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idclase', 'idclase');
    }

}
