<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{

    protected $table          = 'recurso';
    protected $primaryKey     = 'idrecurso';
    protected $fillable       = ['idusuario', 'idclase', 'nombre', 'tipo_recurso', 'url', 'archivo'];

    public function User(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }

    public function Clase(){
        return $this->belongsTo('App\Models\Clase', 'idclase', 'idclase');
    }

}
