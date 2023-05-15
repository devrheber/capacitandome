<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaEncuesta extends Model
{
    use HasFactory;

    public function pregunta() {
        return $this->belongsTo(Pregunta::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'idusuario');
    }
}