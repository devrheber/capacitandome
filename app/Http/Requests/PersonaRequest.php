<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
            'tipo_persona' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            //'dni' => 'required',
            //'telefono' => 'required',
            'iddepartamento' => 'required',
            //'foto' => 'required',
            //'direccion' => 'required',
            //'carrera' => 'required',
            //'perfil' => 'required',
            //'experiencia_laboral' => 'required',
            'usuario' => 'required|unique:users',
            'clave' => 'required',
        ];
    }

    public function messages() {
        return [
            'tipo_persona.required' => 'Tipo persona es requerido.',
            'nombre.required' => 'Nombre es requerido.',
            'apellidos.required' => 'Apellido es requerido.',
            //'dni.required' => 'DNI es requerido.',
            //'dni.unique' => 'DNI|CARNET YA ESTÁ REGISTRADO',
            //'telefono.required' => 'Telefono es requerido.',
            'iddepartamento.required' => 'Departamento es requerido.',
            //'direccion.required' => 'Dirección es requerido.',
            'usuario.required' => 'Usuario es requerido.',
            'usuario.unique' => 'Este usuario ya existe, por favor agregue uno nuevo.',
            'clave.required' => 'Contraseña es requerido.',
            //'carrera.required' => 'Carrera prof. es requerido.',
            //'perfil.required' => 'Perfil es requerido.',
            //'experiencia_laboral.required' => 'Experiencia prof. es requerido.',
        ];
    }
}
