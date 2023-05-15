<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    protected $table          = 'venta';
    protected $primaryKey     = 'idventa';
    protected $fillable       = ['idcurso', 'idusuario', 'fecha_venta', 'precio', 'precio_referencial', 'tipo_comprobante', 'nombre', 'direccion', 'nro_documento', 'boucher_pago', 'estado'];

    public function Curso(){
        return $this->belongsTo('App\Models\Curso', 'idcurso', 'idcurso');
    }

    public function User(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }

}
