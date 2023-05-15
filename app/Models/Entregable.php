<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entregable extends Model
{

    protected $table          = 'entregable';
    protected $primaryKey     = 'identregable';
    protected $fillable       = ['nombre', 'archivo', 'nota', 'idcurso', 'idusuario', 'idseccion', 'fecha', 'estado'];

   

    public function Usuario(){
        return $this->belongsTo('App\Models\Seccion', 'idseccion', 'idseccion');
    }

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

    public function Seccion(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }

}
