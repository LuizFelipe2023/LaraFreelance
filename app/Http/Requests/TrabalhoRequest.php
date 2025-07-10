<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrabalhoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'status' => ['required', 'in:aberto,em_negociacao,fechado'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',
            'descricao.required' => 'A descrição é obrigatória.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status informado é inválido.',
        ];
    }
}
