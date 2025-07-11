<?php

namespace App\Services;

use App\Models\Mensagem;

class MensagemService
{
    
    public function enviar(array $data): Mensagem
    {
        return Mensagem::create([
            'titulo' => $data['titulo'],
            'corpo' => $data['corpo'],
            'user_id' => $data['user_id'],
            'candidatura_id' => $data['candidatura_id'],
        ]);
    }
    public function mensagensPorCandidatura(int $candidaturaId)
    {
        return Mensagem::where('candidatura_id', $candidaturaId)
                       ->orderByDesc('created_at')
                       ->get();
    }

    public function mensagensPorUsuario(int $userId)
    {
        return Mensagem::where('user_id', $userId)
                       ->orderByDesc('created_at')
                       ->get();
    }
}
