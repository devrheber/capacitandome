<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallaCurricular extends Model {
    protected $table          = 'malla_curricular';
    protected $primaryKey     = 'idmalla_curricular';
    protected $fillable       = ['idcurso', 'puntaje_trabajo_final', 'puntaje_examen_final', 'estado'];

}
