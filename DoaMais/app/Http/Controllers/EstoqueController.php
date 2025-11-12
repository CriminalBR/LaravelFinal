<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    // Método para a rota: instituicao.estoque.index
    // (Instituição vendo seu estoque)
    public function index()
    {
        return view('instituicao.estoque.index');
    }
}