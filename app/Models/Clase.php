<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{

    protected $table          = 'clase';
    protected $primaryKey     = 'idclase';
    protected $fillable       = ['idseccion', 'titulo', 'descripcion', 'url_video', 'minutos_video'];

    public function Recursos(){
        return $this->hasMany('App\Models\Recurso', 'idclase', 'idclase');
    }

    public function Comentarios(){
        return $this->hasMany('App\Models\Comentario', 'idclase', 'idclase');
    }

    public function Seccion(){
        return $this->belongsTo('App\Models\Seccion', 'idseccion', 'idseccion');
    }

}
