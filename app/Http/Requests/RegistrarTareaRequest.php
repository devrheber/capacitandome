<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarTareaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
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
            'titulo'  => 'required',
            'archivo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'  => 'Ingrese un titulo.',
            'archivo.required' => 'Importe un archivo.',
        ];
    }
}
