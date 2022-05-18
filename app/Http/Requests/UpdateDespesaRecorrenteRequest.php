<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDespesaRecorrenteRequest extends FormRequest
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
            'nome' => 'required|unique:despesa_recorrente,email,'.$this->user()->id,
            'valor_base' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.unique' => 'Já existe uma despesa cadastrada com esse nome.'
        ];
    }
}
