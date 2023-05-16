<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaContestada extends Model
{
    use HasFactory;

    public function curso() {
        return $this->belongsTo(Curso::class, 'curso_id', 'idcurso');
    }

    public function encuesta() {
        return $this->belongsTo(Encuesta::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'idusuario');
    }
}
