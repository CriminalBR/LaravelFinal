<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use App\Models\Instituicao; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar o Auth

class DoacaoController extends Controller
{
    /**
     * Mostra a lista de doações recebidas (para a instituição).
     */
    public function index()
    {
        // (Ainda vamos fazer esta parte)
        return view('instituicao.doacoes.index');
    }

    /**
     * Mostra o formulário para o doador criar uma nova doação.
     */
    public function create()
    {
        // 1. Buscar todas as instituições que têm um utilizador associado
        //    (Isto garante que só listamos instituições ativas)
        $instituicoes = Instituicao::whereHas('user')->with('user')->get();
        
        // 2. Enviar a lista de instituições para a view
        return view('doador.doacao.create', [
            'instituicoes' => $instituicoes
        ]);
    }

    /**
     * Salva a nova doação enviada pelo doador.
     * (Este é o método que corrigimos de 'post' para 'store')
     */
    public function store(Request $request)
    {
        // 1. Validar os dados do formulário
        $request->validate([
            'instituicao_id' => ['required', 'exists:instituicaos,id'], // Verifica se a instituição existe
            'descricao_item' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        // 2. Criar a doação no banco de dados
        Doacao::create([
            'user_id' => Auth::id(), // ID do doador logado
            'instituicao_id' => $request->instituicao_id,
            'descricao_item' => $request->descricao_item,
            'quantidade' => $request->quantidade,
            'status' => 'pendente', // Status inicial
        ]);
        
        // 3. Redirecionar de volta para o histórico com mensagem de sucesso
        return redirect()->route('doador.historico')->with('success', 'Doação registrada com sucesso! A instituição irá analisar.');
    }
}