<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'tipo_usuario' => ['required', Rule::in([2, 3])],
        ];

        if ($this->isMethod('POST')) {
            $rules['email'][] = 'unique:users,email';
            $rules['password'] = ['required', 'confirmed', 'min:8'];
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'][] = Rule::unique('users', 'email')->ignore($this->route('id'));
            $rules['password'] = ['nullable', 'confirmed', 'min:8'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'tipo_usuario.required' => 'Selecione um tipo de usuário.',
            'tipo_usuario.in' => 'O tipo de usuário selecionado é inválido.',
        ];
    }
}
