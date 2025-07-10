<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidaturaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'         => ['required', 'string', 'max:255'],
            'telefone'     => ['required', 'string', 'max:20'],
            'email'        => ['required', 'email', 'max:255'],
            'endereco'     => ['nullable', 'string', 'max:500'],
            'escolaridade' => ['nullable', 'string', 'max:255'],
            'observacoes'  => ['nullable', 'string'],
            'anexo'        => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'     => 'O nome é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'O e-mail deve ser válido.',
            'anexo.mimes'       => 'O arquivo deve ser um PDF, DOC ou DOCX.',
            'anexo.max'         => 'O arquivo não pode ser maior que 5MB.',
        ];
    }
}
