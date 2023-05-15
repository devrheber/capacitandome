<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreguntasRequest extends FormRequest
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
            'idexamen'                  => 'required',
            'pregunta'                  => 'required',
            'puntos'                    => 'required',
        ];
    }

    public function messages() {
        return [
            'idexamen.required'         => 'No hay exámen seleccionado.',
            'pregunta.required'         => 'Debe ingresar una pregunta.',
            'puntos.required'           => 'Debe especificar los puntos para la pregunta.',
        ];
    }
}
