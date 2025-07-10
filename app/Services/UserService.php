<?php

namespace App\Services;

use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAllUsers(): Collection
    {
        return User::orderBy('name')->with('tipoUsuario')->get();
    }

    public function getUserById(int $id): User
    {
        return User::with('tipoUsuario')->findOrFail($id);
    }

    public function insertUser(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::create($data);
    }

    public function updateUser(int $id, array $data): User
    {
        $user = $this->getUserById($id);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->getUserById($id);
        return $user->delete();
    }
}
