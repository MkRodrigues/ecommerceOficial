<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    public function index()
    {
        // Identifica o usuário autenticado
        $user = auth()->user();
        $cart = $user->cart;

        // Se o usuário (novo usuário), não tiver um carrinho, cria um carirnho vazio
        if ($cart == null) {
            $cart = Cart::updateOrCreate(['user_id' => $user->id]);
        }
        return view('carts.index')->with('products', $cart->products);
    }

    public function store(Product $product)
    {
        // A variável User recebe o usuário que está autenticado no momento
        $user = auth()->user();
        // Se não houver um carrinho criado a função updateOrCreate cria um, e se houve a mesma atualiza o carrinho do usuário
        $cart = Cart::updateOrCreate(['user_id' => $user->id]);

        // Se no carrinho um determinado produto já estiver adicionado, estão não podera ser adicionado novamente
        if ($cart->products()->where('product_id', $product->id)->count()) {
            session()->flash('error', 'O produto (' . $product->name . '), já está no carrinho, e não pode ser adicionado novamente!');
        } else {
            $cart->products()->saveMany([$product]);
            session()->flash('success', 'Produto (' . $product->name . ') adicionado ao carrinho com sucesso!');
        }

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart;
        DB::table('cart_product')->where([['cart_id', $cart->id], ['product_id', $product->id]])->delete();
        session()->flash('success', 'O Produto (' . $product->name . ') foi removido do carrinho com sucesso!');
        return redirect()->back();
    }
}
