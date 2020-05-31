<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica se há categorias criadas, contando a quantidade de categoria através da função count(), se não houver, retorna mensagem de erro informando que uma categoria deve ser criada para que um produto possa ser criado
        if (Category::all()->count() == 0) {
            session()->flash('error', 'Para criar um produto, antes crie uma Categoria');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
