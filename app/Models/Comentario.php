<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $table          = 'comentario';
    protected $primaryKey     = 'idcomentario';
    protected $fillable       = ['fecha', 'comentario', 'idclase', 'idusuario', 'idrespuesta'];

    public function User(){
        return $this->belongsTo('App\User', 'idusuario', 'idusuario');
    }

    public function Clase(){
        return $this->belongsTo('App\Models\Clase', 'idclase', 'idclase');
    }

    public function childrenComentario()
    {
        return $this->hasMany('App\Models\Comentario', 'idrespuesta', 'idcomentario');
    }

    public function parentComentario()
    {
        return $this->belongsTo('App\Models\Comentario', 'idrespuesta', 'idcomentario');
    }

    public function allChildrenComentario()
    {
        return $this->childrenComentario()->with('allChildrenComentario');
    }

    public function allParentComentario()
    {
        return $this->parentComentario()->with('allParentComentario');
    }

}
