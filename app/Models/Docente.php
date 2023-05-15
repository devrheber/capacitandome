<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table          = 'curso_docente_usuario';
    #protected $primaryKey     = 'idrequisitos';
    protected $fillable       = ['idcurso', 'idusuario'];

    //public function Curso(){
        //return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    //}

}
