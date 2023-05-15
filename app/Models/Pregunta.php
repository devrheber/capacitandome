<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{

    protected $table          = 'pregunta';
    protected $primaryKey     = 'idpregunta';
    protected $fillable       = ['idexamen', 'nombre', 'puntos'];

    public function Respuestas(){
        return $this->hasMany('App\Models\Respuesta', 'idpregunta', 'idpregunta');
    }

    public function Alternativas(){
        return $this->hasMany('App\Models\Alternativa', 'idpregunta', 'idpregunta');
    }

    public function Correcta()
    {
        return $this->hasOne('App\Models\Alternativa' ,'idpregunta', 'idpregunta')
        ->where('correcta', 1);
    }

    public function Examen(){
        return $this->belongsTo('App\Models\Examen', 'idexamen', 'idexamen');
    }

    public function DetalleResolverExamen()
    {
       return $this->hasMany('App/Models/DetalleResolverExamen', 'idpregunta', 'idpregunta');
    }

}
