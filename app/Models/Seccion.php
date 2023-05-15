<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{

    protected $table          = 'seccion';
    protected $primaryKey     = 'idseccion';
    protected $fillable       = ['idcurso','nombre_seccion', 'titulo', 'descripcion','entregable', 'estado'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

    public function Entregables(){
        return $this->hasMany('App\Models\Entregable', 'idseccion', 'idseccion');
    }

    public function Clases(){
        return $this->hasMany('App\Models\Clase', 'idseccion', 'idseccion');
    }

    public function Examenes(){
        return $this->hasMany('App\Models\Examen', 'idseccion', 'idseccion');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 1);
    }

    public function scopeDesactivos($query)
    {
        return $query->where('estado', 0);
    }

}
