<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidaturaRequest;
use App\Http\Requests\UpdateCandidaturaRequest;
use App\Models\Candidatura;
use App\Services\CandidaturaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;
use Illuminate\Support\Facades\Log;

class CandidaturaController extends Controller
{
    protected $candidaturaService;

    public function __construct(CandidaturaService $candidaturaService)
    {
        $this->candidaturaService = $candidaturaService;
    }

    public function index(): View
    {
        $candidaturas = $this->candidaturaService->getAllCandidaturas();
        return view('candidaturas.index', compact('candidaturas'));
    }

    public function create(int $trabalhoId): View
    {
        return view('candidaturas.create', ['trabalhoId' => $trabalhoId]);
    }

    public function store(CandidaturaRequest $request, int $trabalhoId): RedirectResponse
    {
        $data = $request->validated();
        
        $data['trabalho_id'] = $trabalhoId;

        if ($request->hasFile('anexo')) {
            $data['anexo'] = $request->file('anexo')->store('curriculos', 'public');
        }

        $data['user_id'] = auth()->id();

        try {
            $this->candidaturaService->storeCandidatura($data);
            return redirect()->route('candidaturas.index')->with('success', 'Candidatura criada com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao salvar candidatura', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data,
            ]);
            return redirect()->back()->withInput()->withErrors('Erro ao salvar candidatura: ' . $e->getMessage());
        }
    }

    public function show(int $id): View
    {
        $candidatura = $this->candidaturaService->getCandidaturaById($id);
        return view('candidaturas.show', compact('candidatura'));
    }

    public function edit(int $id): View
    {
        $candidatura = $this->candidaturaService->getCandidaturaById($id);
        return view('candidaturas.edit', compact('candidatura'));
    }

    public function update(UpdateCandidaturaRequest $request , int $id): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('anexo')) {
            $path = $request->file('anexo')->store('curriculos', 'public');
            $data['anexo'] = $path;
        }

        try {
            $this->candidaturaService->updateCandidatura($id, $data);
            return redirect()->route('candidaturas.index')->with('success', 'Candidatura atualizada com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar candidatura', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data,
                'id' => $id,
            ]);
            return redirect()->back()->withInput()->withErrors('Erro ao atualizar candidatura: ' . $e->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->candidaturaService->deleteCandidatura($id);
            return redirect()->route('candidaturas.index')->with('success', 'Candidatura excluída com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao excluir candidatura', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'id' => $id,
            ]);
            return redirect()->route('candidaturas.index')->withErrors('Erro ao excluir candidatura: ' . $e->getMessage());
        }
    }
}
