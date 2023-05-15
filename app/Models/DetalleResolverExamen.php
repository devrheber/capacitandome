<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleResolverExamen extends Model
{
    protected $table      = 'detalle_resolver_examen';
    protected $primaryKey = 'iddetalle_resolver_examen';
    protected $fillable   = ['idresolver_examen', 'idpregunta', 'idalternativa'];

    public function ResolverExamen()
    {
        return $this->belongsTo('App\Models\ResolverExamen', 'idresolver_examen', 'idresolver_examen');
    }

    public function Pregunta()
    {
        return $this->belongsTo('App\Models\Pregunta', 'idpregunta', 'idpregunta');
    }

    public function Alternativa()
    {
        return $this->belongsTo('App\Models\Alternativa', 'idalternativa', 'idalternativa');
    }
}
