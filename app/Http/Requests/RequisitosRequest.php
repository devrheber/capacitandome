<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitosRequest extends FormRequest
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
            'titulo' => 'required',/*|unique:certificaciones',Rule::unique('certificaciones', 'idconvenios')->ignore($this->idcertificaciones),*/
        ];
    }
    public function messages() {
        return [
                'titulo.required' => 'Ingrese un requisito',
                //'idconvenios.unique'   => 'Este convenio ya está registrado.',
        ];
    }
}
