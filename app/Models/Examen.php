<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{

    protected $table            = 'examen';
    protected $primaryKey       = 'idexamen';
    protected $fillable         = ['titulo', 'fecha_final', 'descripcion', 'idcurso', 'idseccion', 'estado'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

    public function Seccion(){
        return $this->belongsTo('App\Models\Seccion', 'idseccion', 'idseccion');
    }

    public function Preguntas(){
        return $this->hasMany('App\Models\Pregunta', 'idexamen', 'idexamen');
    }

    public function ResolverExamen(){
        return $this->hasMany('App\Models\ResolverExamen', 'idexamen', 'idexamen');
    }

}
