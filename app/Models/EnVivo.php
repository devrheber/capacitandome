<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnVivo extends Model
{

    protected $table          = 'en_vivo';
    protected $primaryKey     = 'iden_vivo';
    protected $fillable       = ['idcurso', 'hora_inicio', 'hora_final', 'link'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

}
