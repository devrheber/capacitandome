<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{

    protected $table          = 'certificados';
    protected $primaryKey     = 'idcertificados';
    protected $fillable       = ['url', 'idcurso', 'idusuario'];

    public function User(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

}
