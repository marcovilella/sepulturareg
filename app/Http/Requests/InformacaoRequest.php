<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class InformacaoRequest extends FormRequest
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
            'nome_permissionario' => ['required'],
            'permissionario_vivo' => ['required'],
            'manutencao_permissao_jazigo' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

}
