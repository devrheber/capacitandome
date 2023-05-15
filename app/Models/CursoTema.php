<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoTema extends Model
{

    protected $table          = 'curso_temas';
    protected $primaryKey     = 'idcurso_tema';
    protected $fillable       = ['idcurso', 'temas'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

}
