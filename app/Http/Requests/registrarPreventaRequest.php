<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registrarPreventaRequest extends FormRequest
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
            'idcurso'            => 'required',
            'name'            => 'required',
            'dni'          => 'required|string|min:5|max:20',
            'email'               => 'required',
        ];
    }

    public function messages() {
        return [
            'idcurso.required'           => 'Curso no identificado.',
            'name.required'           => 'El campo nombre completo es obligatorio.',
            'dni.required'         => 'El campo dni es obligatorio. Caracteres Min 5 - Max 20',
            'email.required'              => 'El campo correo es obligatorio.'
        ];
    }
}
