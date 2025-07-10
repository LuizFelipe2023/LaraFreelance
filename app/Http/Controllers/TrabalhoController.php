<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabalhoRequest;
use App\Services\TrabalhoService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TrabalhoController extends Controller
{
    protected $trabalhoService;

    public function __construct(TrabalhoService $trabalhoService)
    {
        $this->trabalhoService = $trabalhoService;
    }

    public function index(Request $request): View
    {
        $trabalhos = $this->trabalhoService->getAll(
            $request->input('status'),
            $request->input('search')
        );

        return view('trabalhos.index', compact('trabalhos'));
    }

    public function show(int $id): View
    {
        $trabalho = $this->trabalhoService->getById($id);
        return view('trabalhos.show', compact('trabalho'));
    }


    public function create(): View
    {
        return view('trabalhos.create');
    }

    public function store(TrabalhoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        try {
            $this->trabalhoService->create($data);
            return redirect()->route('trabalhos.index')->with('success', 'Trabalho criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors('Erro ao criar trabalho: ' . $e->getMessage());
        }
    }

    public function edit(int $id): View
    {
        $trabalho = $this->trabalhoService->getById($id);
        return view('trabalhos.edit', compact('trabalho'));
    }

    public function update(TrabalhoRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        try {
            $this->trabalhoService->update($id, $data);
            return redirect()->route('trabalhos.index')->with('success', 'Trabalho atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors('Erro ao atualizar trabalho: ' . $e->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->trabalhoService->delete($id);
            return redirect()->route('trabalhos.index')->with('success', 'Trabalho excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('trabalhos.index')->withErrors('Erro ao excluir trabalho: ' . $e->getMessage());
        }
    }
}
