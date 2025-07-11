<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FavoritoService;

class FavoritoController extends Controller
{
    protected $favoritoService;

    public function __construct(FavoritoService $favoritoService)
    {
        $this->favoritoService = $favoritoService;
    }

    /**
     * Alterna favorito (add/remove)
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'trabalho_id' => 'nullable|exists:trabalhos,id',
            'candidatura_id' => 'nullable|exists:candidaturas,id',
        ]);

        $data = $request->only('trabalho_id', 'candidatura_id');

        if ($this->favoritoService->isFavorito($data)) {
            $this->favoritoService->removeFavorito($data);
            return response()->json(['status' => 'removed']);
        } else {
            $this->favoritoService->insertFavorito($data);
            return response()->json(['status' => 'added']);
        }
    }
}
