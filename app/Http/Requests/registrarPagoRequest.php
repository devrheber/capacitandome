<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registrarPagoRequest extends FormRequest
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
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'telefono' => 'required',
            'iddepartamento' => 'required',
            'direccion' => 'required',
            'acepto' => 'required',
        ];
    }

    public function messages() {
        return [
            'titulo.required' => 'El campo nombre es obligatorio.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'dni.required' => 'El campo dni es obligatorio.',
            'telefono.required' => 'El campo telefono es obligatorio.',
            'iddepartamento.required' => 'El campo departamento es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'acepto.required' => 'El campo términos y condiciones es obligatorio.',
        ];
    }
}
