<?php

namespace App\Services;

use App\Models\Candidatura;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CandidaturaService
{
    public function getAllCandidaturas()
    {
        return Candidatura::orderByDesc('created_at')->get();
    }

    public function getCandidaturaById($id)
    {
        return Candidatura::findOrFail($id);
    }

    public function getAllByTrabalho(int $trabalhoId)
    {
        return Candidatura::where('trabalho_id', $trabalhoId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function storeCandidatura(array $data)
    {
        $this->handleAnexo($data);
        return Candidatura::create($data);
    }

    public function updateCandidatura($id, array $data)
    {
        $this->handleAnexo($data);
        $candidatura = $this->getCandidaturaById($id);
        $candidatura->update($data);
        return $candidatura;
    }

    public function deleteCandidatura($id)
    {
        $candidatura = $this->getCandidaturaById($id);

        if ($candidatura->anexo) {
            Storage::disk('public')->delete($candidatura->anexo);
        }

        return $candidatura->delete();
    }

    /**
     * Trata o upload de currículo se fornecido.
     */
    private function handleAnexo(array &$data): void
    {
        if (isset($data['anexo']) && $data['anexo'] instanceof UploadedFile) {
            $data['anexo'] = $data['anexo']->store('curriculos', 'public');
        }
    }
}
