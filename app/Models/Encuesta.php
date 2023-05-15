<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encuesta extends Model
{
    use HasFactory;

    public function curso(): BelongsTo {
        return $this->belongsTo(Curso::class, 'curso_id', 'idcurso');
    }

    public function pregunta_encuestas(): HasMany {
        return $this->hasMany(PreguntaEncuesta::class);
    }

    public function encuesta_estado(){
        switch ($this->estado) {
            case 0:
                return 'Deshabilitado';
            case 1:
                return 'Habilitado';
            case 2:
                return 'Publicado';
            default:
                # code...
                break;
        }
    }
}
