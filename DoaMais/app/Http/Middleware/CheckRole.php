<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importe o Auth
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  // Aceita múltiplos perfis (ex: 'doador', 'admin')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Verifica se o usuário está logado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Pega o perfil do usuário logado
        $userRole = Auth::user()->role;

        // 3. Verifica se o perfil do usuário está na lista de perfis permitidos ($roles)
        if (!in_array($userRole, $roles)) {
            // Se não tiver permissão, joga um erro 403 (Acesso Negado)
            abort(403, 'ACESSO NÃO AUTORIZADO.');
        }

        // 4. Se tiver permissão, deixa a requisição continuar
        return $next($request);
    }
}