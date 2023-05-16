<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaEncuesta extends Model
{
    use HasFactory;

    public function pregunta() {
        return $this->belongsTo(PreguntaEncuesta::class, 'pregunta_encuesta_id', 'id');
    }

    public function encuesta_contestada() {
        return $this->hasOne(EncuestaContestada::class);
    }
}
