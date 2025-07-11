<?php

namespace App\Services;

use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;

class FavoritoService
{
    /**
     * Favorita um trabalho ou candidatura
     */
    public function insertFavorito(array $data): Favorito
    {
        return Favorito::create([
            'user_id' => Auth::id(),
            'trabalho_id' => $data['trabalho_id'] ?? null,
            'candidatura_id' => $data['candidatura_id'] ?? null,
        ]);
    }

    /**
     * Remove um favorito
     */
    public function removeFavorito(array $data): bool
    {
        return Favorito::where('user_id', Auth::id())
            ->where('trabalho_id', $data['trabalho_id'] ?? null)
            ->where('candidatura_id', $data['candidatura_id'] ?? null)
            ->delete();
    }

    /**
     * Verifica se o item está favoritado
     */
    public function isFavorito(array $data): bool
    {
        return Favorito::where('user_id', Auth::id())
            ->where('trabalho_id', $data['trabalho_id'] ?? null)
            ->where('candidatura_id', $data['candidatura_id'] ?? null)
            ->exists();
    }
}
