<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'sobrenome' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:32',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Preencha seu primeiro nome.',
            'name.min' => 'Seu nome deve ter ao menos 3 caracteres.',

            'sobrenome.required' => 'Preencha seu sobrenome.',
            'sobrenome.min' => 'Seu sobrenome deve ter ao menos 3 caracteres.',

            'email.required' => 'Preencha seu endereço de email',
            'email.email' => 'Endereço de email inválido.',
            'email.unique' => 'Já existe um usuário cadastrado em esse email.',

            'password.required' => 'Informe uma senha.',
            'password.min' => 'Sua senha deve possuir entre 8 e 32 caracteres.',
            'password.max' => 'Sua senha deve possuir entre 8 e 32 caracteres.'
        ];
    }
}
