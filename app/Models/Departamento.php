<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{

    protected $table          = 'departamento';
    protected $primaryKey     = 'iddepartamento';
    protected $fillable       = ['departamento'];

    public function Personas(){
        return $this->belongsTo('App\Models\Persona', 'iddepartamento', 'iddepartamento');
    }

}
