<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registrarClienteRequest extends FormRequest
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
            'nombre'            => 'required',
            'apellido'          => 'required',
            'dni_i'               => 'required',
            'telefono'          => 'required',
            'correo'            => 'required',
            'iddepartamento'    => 'required',
            'direccion'         => 'required',
            'usuario'           => 'required|unique:users',
            'clave'             => 'required',
            'acepto'            => 'required',
        ];
    }

    public function messages() {
        return [
            'titulo.required'           => 'El campo nombre es obligatorio.',
            'apellido.required'         => 'El campo apellido es obligatorio.',
            'dni_i.required'              => 'El campo dni es obligatorio.',
            'telefono.required'         => 'El campo telefono es obligatorio.',
            'telefono.correo'           => 'El campo correo es obligatorio.',
            'iddepartamento.required'   => 'El campo departamento es obligatorio.',
            'direccion.required'        => 'El campo dirección es obligatorio.',
            'usuario.required'          => 'El campo usuario es obligatorio.',
            'usuario.unique'            => 'El usuario ya está registrado, por favor ingrese un nuevo usuario.',
            'clave.required'            => 'El campo contraseña es obligatorio.',
            'acepto.required'           => 'El campo términos y condiciones es obligatorio.',
        ];
    }
}
