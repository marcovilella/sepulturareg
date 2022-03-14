<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class NovaSenhaRequest extends FormRequest
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
            'senhaantiga' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'senhaantiga.required' => 'O campo senha antiga é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha tem que ser no mínimo de 8 caracteres.',
            'password.confirmed' => 'Os campos senha e confirmação de senha devem ser iguais. ',
        ];
    }

}
