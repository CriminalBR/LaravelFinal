<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importe o Auth

class DoadorController extends Controller
{
    /**
     * Mostra o histórico de doações do doador logado.
     */
    public function historico()
    {
        // 1. Buscar as doações do usuário logado
        //    Usamos ->doacoes() para aceder ao relacionamento que definimos no Model User
        //    Usamos ->with('instituicao.user') para carregar os dados da instituição e o nome dela (user.name)
        //    Usamos ->latest() para ordenar pelas mais recentes
        $doacoes = Auth::user()->doacoes()->with('instituicao.user')->latest()->get();

        // 2. Enviar os dados para a view
        return view('doador.historico', [
            'doacoes' => $doacoes
        ]);
    }
}