<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'Doc_Ident' => ['required'],
            'name' => ['required'],
            'email' => [ 'nullable', 'email:rfc,dns,strict,spoof,filter' ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'CPF' => [ 'required', 'string', 'min:14', 'unique:users' ],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Doc_Ident.required' => 'O campo Documento de Identificação é obrigatório',
            'name.required' => 'O campo nome é obrigatório',
            'CPF.min' => 'O campo CPF está inválido',
            'email' => 'O email precisa ser válido',
            'cpf.unique' => 'CPF já cadastrado',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha tem que ser no mínimo de 8 caracteres.',
            'password.confirmed' => 'Os campos senha e confirmação de senha devem ser iguais. ',
        ];
    }

}
