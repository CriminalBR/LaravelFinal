<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\DoadorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rotas de Usuário Logado (Precisa estar logado, mas não importa o perfil)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Rota principal do Dashboard (será controlada pelo HomeController)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Rotas de Perfil (do Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Rotas de DOADOR (Precisa estar logado E ter role 'doador')
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:doador'])->prefix('doador')->name('doador.')->group(function () {
        // Ex: /doador/historico
        Route::get('/historico', [DoadorController::class, 'historico'])->name('historico');

        // Ex: /doador/doar (página de fazer doação)
        Route::get('/doar', [DoacaoController::class, 'create'])->name('doacao.create');

        // Ex: /doador/doar (ação de salvar a doação)
        Route::post('/doar', [DoacaoController::class, 'store'])->name('doacao.store');
    });


    /*
    |--------------------------------------------------------------------------
    | Rotas de INSTITUIÇÃO (Precisa estar logado E ter role 'instituicao')
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:instituicao'])->prefix('instituicao')->name('instituicao.')->group(function () {

        // Ex: /instituicao/doacoes (ver doações recebidas)
        Route::get('/doacoes', [DoacaoController::class, 'index'])->name('doacao.index');

        // Ex: /instituicao/estoque (ver estoque)
        Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');

        
    });

});

// Inclui as rotas de autenticação (login, register, etc.)
require __DIR__.'/auth.php';