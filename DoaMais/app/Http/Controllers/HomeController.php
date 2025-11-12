<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class HomeController extends Controller
{
    /**
     * Redireciona o usuário para o dashboard correto com base no seu 'role'.
     */
    public function index()
    {
        // Pega o 'role' do usuário que está logado
        $role = Auth::user()->role;

        // Verifica o 'role' e redireciona
        if ($role == 'instituicao') {
            // Se for instituição, manda para a rota de estoque
            return redirect()->route('instituicao.estoque.index');

        } elseif ($role == 'doador') {
            // Se for doador, manda para a rota de histórico
            return redirect()->route('doador.historico');

        } else {
            // Se for qualquer outra coisa (ex: admin futuro ou erro),
            // apenas mostra o dashboard padrão do Breeze.
            return view('dashboard');
        }
    }
}