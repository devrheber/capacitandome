<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Curso extends Model
{

    protected $table          = 'curso';
    protected $primaryKey     = 'idcurso';
    protected $fillable       = [
        'titulo',
        'portada',
        'url_video_intro',
        'url_portada_det',
        'plan',
        'hora_duracion',
        'total_clases',
        'precio',
        'idcategoria',
        'descripcion',
        'descripcion_larga',
        'fecha_inicio',
        'fecha_final',
        'cetificado',
        'recursos',
        'modalidad',
        'plataforma',
        'nom_certificado',
        'brochure',
        'estado'
    ];

    public function encuesta(): HasOne {
        return $this->hasOne(Encuesta::class);
    }

    public function CursoDocenteUsuarios(){
        return $this->belongsToMany('App\Models\Usuario', 'curso_docente_usuario', 'idcurso', 'idusuario');
    }

    public function CursoTemas(){
        return $this->hasMany('App\Models\CursoTema', 'idcurso', 'idcurso');
    }

    public function Certificados(){
        return $this->hasMany('App\Models\Certificado', 'idcurso', 'idcurso');
    }

    public function EnVivos(){
        return $this->hasMany('App\Models\EnVivo', 'idcurso', 'idcurso');
    }

    public function Requisitos(){
        return $this->hasMany('App\Models\Requisito', 'idcurso', 'idcurso');
    }

    public function Secciones(){
        return $this->hasMany('App\Models\Seccion', 'idcurso', 'idcurso');
    }

    public function Ventas(){
        return $this->hasMany('App\Models\Venta', 'idcurso', 'idcurso');
    }

    public function Categoria(){
        return $this->belongsTo('App\Models\Categoria', 'idcategoria', 'idcategoria');
    }

    public function Examenes(){
        return $this->hasMany('App\Models\Examen', 'idcurso', 'idcurso');
    }

    public function ComunidadEstudiantes(){
        return $this->hasMany('App\Models\ComunidadEstudiante', 'idcurso', 'idcurso');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 1);
    }

    public function scopeDesactivos($query)
    {
        return $query->where('estado', 0);
    }

    /** Estado del curso **/
    public function course_status(){
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
