<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabalho;
use App\Models\Candidatura;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $totalTrabalhos = Trabalho::where('status', 'aberto')->count();
        $totalCandidaturas = Candidatura::count();
        $totalEmpresas = User::where('tipo_usuario', 2)->count(); 

        return view('dashboard', compact('totalTrabalhos', 'totalCandidaturas', 'totalEmpresas'));
    }
}
