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
            "nome" => "required",
            "valor" => "required|numeric",
            "forma_pagamento" => "required|in:p,b,d",

            "boleto" => "nullable|max:2000|mimes:pdf,jpeg,png",
            "comprovante" => "nullable|max:2000|mimes:pdf,jpeg,png",
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
