<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table          = 'rol';
    protected $primaryKey     = 'idrol';
    protected $fillable       = ['rol'];

    public function Users(){
        return $this->hasMany('App\Models\User', 'idrol', 'idrol');
    }

}
