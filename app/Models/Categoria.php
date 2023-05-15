<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table          = 'categoria';
    protected $primaryKey     = 'idcategoria';
    protected $fillable       = ['categoria', 'icono', 'estado'];

    public function Cursos(){
        return $this->hasMany('App\Models\Curso', 'idcategoria', 'idcategoria');
    }

}
