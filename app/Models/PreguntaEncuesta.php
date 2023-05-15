<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreguntaEncuesta extends Model
{
    use HasFactory;

    public function encuesta(): BelongsTo {
        return $this->belongsTo(Encuesta::class);
    }
}
