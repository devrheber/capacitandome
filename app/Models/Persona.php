<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{

    protected $table          = 'persona';
    protected $primaryKey     = 'idpersona';
    protected $fillable       = 
                                [
                                    'tipo_persona', 
                                    'nombre', 
                                    'apellidos', 
                                    'dni', 
                                    'telefono', 
                                    'iddepartamento', 
                                    'correo', 
                                    'direccion', 
                                    'foto', 
                                    'carrera', 
                                    'perfil', 
                                    'experiencia_laboral'
                                ];

    public function Departamento(){
        return $this->belongsTo('App\Models\Departamento', 'iddepartamento', 'iddepartamento');
    }

    public function Users(){
        return $this->hasMany('App\User', 'idpersona', 'idpersona');
    }

}
