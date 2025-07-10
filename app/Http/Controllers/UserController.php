<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\UsuarioTipoService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Log;

class UserController extends Controller
{
    protected $userService, $usuarioTipoService;

    public function __construct(UserService $userService, UsuarioTipoService $usuarioTipoService)
    {
        $this->userService = $userService;
        $this->usuarioTipoService = $usuarioTipoService;
    }

    public function index()
    {
        try {
            $users = $this->userService->getAllUsers();
            $tiposUsuario = $this->usuarioTipoService->getAllUsuariosTipo();
            return view('users.index', compact('users', 'tiposUsuario'));
        } catch (Exception $e) {
            Log::error('Erro ao listar usuários: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao recuperar a lista de usuários.');
        }
    }

    public function createUser()
    {
        try {
            $usuariosTipo = $this->usuarioTipoService->getAllUsuariosTipo();
            return view('users.create', compact('usuariosTipo'));
        } catch (Exception $e) {
            Log::error('Erro ao carregar tipos de usuário: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao carregar tipos de usuário.');
        }
    }

    public function storeUser(UserRequest $request)
    {
        try {
            $this->userService->insertUser($request->validated());
            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao criar usuário: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao criar usuário.')->withInput();
        }
    }

    public function editUser($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            $usuariosTipo = $this->usuarioTipoService->getAllUsuariosTipo();
            return view('users.edit', compact('user', 'usuariosTipo'));
        } catch (Exception $e) {
            Log::error('Erro ao carregar usuário para edição: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao carregar usuário.');
        }
    }

    public function updateUser(UserRequest $request, $id)
    {
        try {
            $this->userService->updateUser($id, $request->validated());
            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar usuário: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao atualizar usuário.')->withInput();
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->userService->deleteUser($id);
            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao excluir usuário: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao excluir usuário.');
        }
    }

}
