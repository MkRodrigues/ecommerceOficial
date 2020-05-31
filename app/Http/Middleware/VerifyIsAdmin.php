<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsAdmin
{

    public function handle($request, Closure $next)
    {
        // Se o usuário não for administrador, este será redirecionado para a página inicials
        if (!auth()->user()->isAdmin()) {
            return redirect(route('home'));
        }
        return $next($request);
    }
}
