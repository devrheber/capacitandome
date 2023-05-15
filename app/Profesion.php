<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Mode {

    protected $table = 'profesion';

    protected $fillable = [ 
        'prof_id', 
        'prof_nombre',
    ];
}
