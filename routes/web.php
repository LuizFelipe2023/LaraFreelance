<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrabalhoController;
use App\Http\Controllers\CandidaturaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoritoController;




Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // Listar usuários
        Route::get('/create', [UserController::class, 'createUser'])->name('createUser'); 
        Route::post('/store', [UserController::class, 'storeUser'])->name('storeUser'); 

        Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('editUser'); 
        Route::put('/update/{id}', [UserController::class, 'updateUser'])->name('updateUser'); 

        Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser'); 
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/trabalhos', [TrabalhoController::class, 'index'])->name('trabalhos.index');
    Route::get('/trabalho/{id}',[TrabalhoController::class,'show'])->name('trabalhos.show');
    Route::get('/trabalhos/create', [TrabalhoController::class, 'create'])->name('trabalhos.create');
    Route::post('/trabalhos', [TrabalhoController::class, 'store'])->name('trabalhos.store');
    Route::get('/trabalhos/{id}/edit', [TrabalhoController::class, 'edit'])->name('trabalhos.edit');
    Route::put('/trabalhos/{id}', [TrabalhoController::class, 'update'])->name('trabalhos.update');
    Route::delete('/trabalhos/{id}', [TrabalhoController::class, 'destroy'])->name('trabalhos.destroy');
});

Route::middleware(['auth'])->prefix('trabalhos/{trabalho}/candidaturas')->name('candidaturas.')->group(function () {
    Route::get('/create', [CandidaturaController::class, 'create'])->name('create');
    Route::post('/', [CandidaturaController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->prefix('candidaturas')->name('candidaturas.')->group(function () {
    Route::get('/', [CandidaturaController::class, 'index'])->name('index');
    Route::get('/{id}', [CandidaturaController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CandidaturaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CandidaturaController::class, 'update'])->name('update');
    Route::delete('/{id}', [CandidaturaController::class, 'destroy'])->name('destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::post('/favorito/toggle', [FavoritoController::class, 'toggle'])->name('favorito.toggle');



require __DIR__ . '/auth.php';
