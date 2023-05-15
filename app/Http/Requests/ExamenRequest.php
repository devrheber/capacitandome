<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idcurso'                   => 'required',
            'idseccion'                 => 'required',
            'titulo'                    => 'required',
            'descripcion'               => 'required',
            'fecha_fin'                 => 'required',
        ];
    }

    public function messages() {
        return [
            'titulo.required'           => 'El campo titulo es obligatorio.',
            'idseccion.required'        => 'Debe seleccionar una seccion para el exámen',
            'descripcion.required'      => 'El campo descripción es obligatorio.',
            'fecha_fin.required'        => 'Debe ingresar una fecha y hora final',
        ];
    }
}
