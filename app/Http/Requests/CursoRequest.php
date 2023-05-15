<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() {
        return [
            'titulo' => 'required',
            'portada' => 'required',
            'plan' => 'required',
            'hora_duracion' => 'required',
            'precio' => 'required',
            'idcategoria' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'descripcion' => 'required',
        ];
    }

    public function messages() {
        return [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'portada.required' => 'El campo imagen es obligatorio.',
            'plan.required' => 'El campo curso plan es obligatorio.',
            'hora_duracion.required' => 'El campo total horas es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'idcategoria.required' => 'El campo categoria es obligatorio.',
            'fecha_inicio.required' => 'El campo fecha inicio es obligatorio.',
            'fecha_final.required' => 'El campo fecha final es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
        ];
    }
}
