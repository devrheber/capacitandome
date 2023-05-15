<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarVoucherRequest extends FormRequest
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
            'idcurso'       => 'required',
            'idusuario'     => 'required',
            'boucher_pago'  => 'required|mimes:jpg,jpeg,bmp,png'
        ];
    }

    public function messages() {
        return [
            'idcurso.required'      => 'idcurso es requerido.',
            'idusuario.required'    => 'idusuario es requerido.',
            'boucher_pago.required' => 'Voucher de pago es requerido.'
        ];
    }
}
