<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificadoRequest extends FormRequest
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
            'idCurso'                       => 'required',
            'idUser'                        => 'required',
            'certificado'                   => 'required',
        ];
    }

    public function messages() {
        return [
            'idCurso.required'              => 'No hay un curso seleccionado.',
            'idUser.required'               => 'No hay estudiante seleccionado.',
            'certificado.required'         => 'Debe seleccionar un certificado.',
        ];
    }
}
