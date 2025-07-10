<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidaturaRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajuste se precisar de autorização específica
    }

    public function rules()
    {
        return [
            'trabalho_id'  => ['required', 'exists:trabalhos,id'],
            'nome'         => ['required', 'string', 'max:255'],
            'telefone'     => ['required', 'string', 'max:20', 'regex:/^\+?\d{8,20}$/'], 
            // aceita números com opcional +, de 8 a 20 dígitos
            'email'        => ['required', 'email', 'max:255'],
            'endereco'     => ['required', 'string', 'max:500'],
            'escolaridade' => ['required', 'string', 'max:255'],
            'observacoes'  => ['nullable', 'string'],
            'anexo'        => ['nullable', 'file', 'mimes:pdf', 'max:5120'], // máximo 5MB, só PDF
        ];
    }

    public function messages()
    {
        return [
            'trabalho_id.required' => 'O campo trabalho é obrigatório.',
            'trabalho_id.exists'   => 'O trabalho selecionado é inválido.',

            'nome.required'        => 'O nome é obrigatório.',
            'nome.string'          => 'O nome deve ser um texto válido.',
            'nome.max'             => 'O nome não pode ter mais que 255 caracteres.',

            'telefone.required'    => 'O telefone é obrigatório.',
            'telefone.string'      => 'O telefone deve ser um texto válido.',
            'telefone.max'         => 'O telefone não pode ter mais que 20 caracteres.',
            'telefone.regex'       => 'O telefone deve conter entre 8 e 20 dígitos, podendo começar com +.',

            'email.required'       => 'O e-mail é obrigatório.',
            'email.email'          => 'O e-mail deve ser válido.',
            'email.max'            => 'O e-mail não pode ter mais que 255 caracteres.',

            'endereco.required'    => 'O endereço é obrigatório.',
            'endereco.string'      => 'O endereço deve ser um texto válido.',
            'endereco.max'         => 'O endereço não pode ter mais que 500 caracteres.',

            'escolaridade.required'=> 'A escolaridade é obrigatória.',
            'escolaridade.string'  => 'A escolaridade deve ser um texto válido.',
            'escolaridade.max'     => 'A escolaridade não pode ter mais que 255 caracteres.',

            'observacoes.string'   => 'As observações devem ser um texto válido.',

            'anexo.file'           => 'O arquivo do currículo deve ser um arquivo válido.',
            'anexo.mimes'          => 'O arquivo do currículo deve ser um arquivo PDF.',
            'anexo.max'            => 'O arquivo do currículo não pode ultrapassar 5MB.',
        ];
    }
}
