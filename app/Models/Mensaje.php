<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{

    protected $table          = 'mensajes';
    protected $primaryKey     = 'idmensajes';
    protected $fillable       = ['fecha', 'nombre_apellido', 'correo', 'telefono', 'mensaje', 'estado'];

}
