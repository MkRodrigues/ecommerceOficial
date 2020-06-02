@extends('layouts.store')

@section('content')
<h1>Carrinho de Compras</h1>
<section class="container py-4">
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->discountPrice()}}</td>
                <td><a href="{{ route('cart-remove', $product->id) }}" class="btn btn-danger btn-sm">Remover</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Finalizar Compra - Pegar os produtos do carrinho, jogar na tabela de pedidos, e limpar a tabela Carrinho de compras --}}
    <a href="" class="btn btn-primary btn-lg">Finalizar Compra</a>
</section>
@endsection