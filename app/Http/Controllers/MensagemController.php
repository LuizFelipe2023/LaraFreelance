<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MensagemService;

class MensagemController extends Controller
{
    protected $mensagemService;

    public function __construct(MensagemService $mensagemService)
    {
        $this->mensagemService = $mensagemService;
    }

    /**
     * Armazena uma nova mensagem.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'corpo' => 'required|string',
            'candidatura_id' => 'required|exists:candidaturas,id',
        ]);

        $this->mensagemService->enviar([
            'titulo' => $request->titulo,
            'corpo' => $request->corpo,
            'user_id' => auth()->id(),
            'candidatura_id' => $request->candidatura_id,
        ]);

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
