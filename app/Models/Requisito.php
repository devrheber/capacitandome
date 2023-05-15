<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $table          = 'requisitos';
    protected $primaryKey     = 'idrequisitos';
    protected $fillable       = ['idcurso', 'requisitos'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

}
