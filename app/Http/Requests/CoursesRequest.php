<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "titulo"                            => "required|min:5|max:250",
            "portada"                           => "required",
            "url_video_intro"                   => "required",
            "url_portada_det"                   => "required",
            "plan"                              => "required",
            "idcategoria"                       => "required",
            "hora_duracion"                     => "required",
            "total_clases"                      => "required",
            "precio"                            => "required",
            "descripcion"                       => "required",
            "descripcion_larga"                 => "required",
            "fecha_inicio"                      => "required",
            "fecha_final"                       => "required",
            "certificado"                       => "required",
            "recursos"                          => "required",
            "modalidad"                         => "required",
            "plataforma"                        => "required",
            "nom_certificado"                   => "required",
            "brochure"                          => "required"
        ];
    }

    public function messages()
    {
        return [

            "titulo.required"                            => "Debe ingresar un titulo.",
            "titulo.min"                                 => "El titulo debeb tener al menos 5 letras.",
            "titulo.max"                                 => "El titulo debeb tener menos de 250 letras.",

            "idcategoria.required"                       => "Seleccione una categoria",
            "portada.required"                           => "Debe ingresar una imagen principal.",
            "url_video_intro.required"                   => "Debe ingresar la url del video de introducción.",
            "url_portada_det.required"                   => "Debe ingresar una imagen secundaria.",
            "plan.required"                              => "Seleccione un plan.",
            "hora_duracion.required"                     => "Debe ingresar la duracion en horas.",
            "total_clases.required"                      => "Debe ingresar el total de clases.",
            "precio.required"                            => "Debe ingresar un precio.",
            "descripcion.required"                       => "Debe ingresar una descripcion corta.",
            "descripcion_larga.required"                 => "Debe ingresar una descripcion detallada.",
            "fecha_inicio.required"                      => "Debe ingresar una fecha de inicio.",
            "fecha_final.required"                       => "Debe ingresar la fecha final.",
            "certificado.required"                       => "Debe seleccionar si hay o no certificado.",
            "recursos.required"                          => "Debe seleccionar si hay o no recursos.",
            "modalidad.required"                         => "Debe seleccionar una modalidad.",
            "plataforma.required"                        => "Debe seleccionar una plataforma.",

            "nom_certificado.required"                   => "Debe ingresar nombre del certificado de finalización.",
            "brochure.required"                          => "Debe importar el brochure del curso."

        ];
    }
}
