<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{

    protected $table          = 'alternativa';
    protected $primaryKey     = 'idalternativa';
    protected $fillable       = ['idpregunta', 'nombre', 'correcta'];

    public function Pregunta(){
        return $this->belongsTo('App\Models\Pregunta', 'idpregunta', 'idpregunta');
    }

    public function DetallesResolverExamen()
    {
        return $this->hasMany('App\Models\DetalleResolverExamen', 'idalternativa', 'idalternativa');
    }

}
