<?php

namespace App\Http\Requests\Encuesta;

use Illuminate\Foundation\Http\FormRequest;

class EncuestaEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "titulo" => "required|min:5|max:250",
//            "idcurso" => "required",
            "descripcion" => "required",
        ];
    }

    public function messages()
    {
        return [

            "titulo.required"                            => "Debe ingresar un titulo.",
            "titulo.min"                                 => "El titulo debeb tener al menos 5 letras.",
            "titulo.max"                                 => "El titulo debeb tener menos de 250 letras.",
//            "idcurso.required"                           => "Debe seleccionar un curso",
            "descripcion.required"                       => "Debe ingresar una descripción."
        ];
    }
}
