<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaCurricularRequest extends FormRequest
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
            'idcurso'                       => 'required',
            'examen_final'                  => 'required|numeric',
            'trabajo_final'                 => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'idcurso.required'             => 'Seleccione un curso.',
            'examen_final.required'        => 'Ingrese puntaje examen final.',
            'examen_final.numeric'         => 'Puntaje examen final debe ser numérico.',
            'trabajo_final.required'       => 'Ingrese puntaje trabajo final.',
            'trabajo_final.numeric'        => 'Puntaje trabajo final debe ser numérico.',
        ];
    }
}
