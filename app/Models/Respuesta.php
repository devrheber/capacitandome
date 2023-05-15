<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{

    protected $table          = 'respuesta';
    protected $primaryKey     = 'idrespuesta';
    protected $fillable       = ['idpregunta', 'idalternativa', 'idusuario'];

    public function Pregunta(){
        return $this->belongsTo('App\Models\Pregunta', 'idpregunta', 'idpregunta');
    }

    public function Alternativa(){
        return $this->belongsTo('App\Models\Alternativa', 'idalternativa', 'idalternativa');
    }

    public function User(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }

}
