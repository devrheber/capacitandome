<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComunidadRequest extends FormRequest
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
    public function rules() {
        return [
            'comunidad_estudiantil' => 'required',
        ];
    }
    public function messages() {
        return [
                'comunidad_estudiantil.required' => 'Ingrese la comunidad a la cual va dirigido el curso.',
                //'idconvenios.unique'   => 'Este convenio ya está registrado.',
        ];
    }
}
