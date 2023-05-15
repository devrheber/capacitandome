<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RespuestaEncuestaRequest extends FormRequest
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
            'pregunta_encuesta_id' => 'required',
            'user_id' => [
                'required',
                Rule::unique('respuesta_encuestas')->where(function ($query) {
                    $query->where('pregunta_encuesta_id', $this->input('pregunta_encuesta_id'));
                })
            ],
        ];
    }

    public function messages()
    {
        return [
            'user_id.unique' => 'No se puede repetir una respuesta para esta encuesta',
        ];
    }
}
