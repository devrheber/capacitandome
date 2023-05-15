<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResolverExamen extends Model
{
    protected $table          = 'resolver_examen';
    protected $primaryKey     = 'idresolver_examen';
    protected $fillable       = [
        'idusuario', 'idexamen',
        'fecha_inicio', 'fecha_final',
        'calificacion_total',
        'calificacion_final',  'notas'
    ];

    public function Examen()
    {
        return $this->belongsTo('App\Models\Examen', 'idexamen', 'idexamen');
    }

    public function DetalleResolverExamen()
    {
        return $this->hasMany('App\Models\DetalleResolverExamen', 'idresolver_examen', 'idresolver_examen');
    }

    public function User(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }


}
