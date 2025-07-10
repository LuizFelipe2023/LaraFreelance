<?php

namespace App\Services;

use App\Models\Trabalho;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TrabalhoService
{
    public function getAll(?string $status = null, ?string $search = null, int $perPage = 9): LengthAwarePaginator
    {
        $query = Trabalho::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                    ->orWhere('descricao', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getByCliente(int $clienteId): Collection
    {
        return Trabalho::where('user_id', $clienteId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getById(int $id): Trabalho
    {
        return Trabalho::findOrFail($id);
    }

    public function create(array $data): Trabalho
    {
        return Trabalho::create($data);
    }

    public function update(int $id, array $data): Trabalho
    {
        $trabalho = $this->getById($id);
        $trabalho->update($data);
        return $trabalho;
    }

    public function delete(int $id): bool
    {
        $trabalho = $this->getById($id);
        return $trabalho->delete();
    }
}
