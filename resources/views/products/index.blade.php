@extends('layouts.app')

@section('content')
<h2>Lista de Produtos</h2>
<div class="d-flex mb-2 justify-content-end">
    <a class="btn btn-success right" href="{{route('products.create')}}">Novo Produto</a>
</div>
<div class="">
    <ul class="list-group">
        @foreach($products as $product)
        <li class="list-group-item">
            <img src="{{ asset('storage/'.$product->image) }}" width="40" height="40">
            <span>{{$product->name}}</span>
            <div class="float-right">
                {{-- Se o produto não estiver na Lixeira os botões Visualizar e Editar serão mostrados --}}
                @if(!$product->trashed())
                <a class="btn btn-primary btn-sm float-left ml-1" href="">Visualizar</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm float-left ml-1" href="">Editar</a>

                {{-- Se ele estiver na lixeira, o botão Reativar será mostrado --}}
                @else
                {{-- Formulário de Restaurar produto da Lixeira --}}
                <form action="{{ route('restore-products.update', $product->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer restaurar este dado?')">
                    @csrf
                    @method('PUT')
                    {{-- Se o produto estiver apagado, o botão mostrado será "Excluir", se não estiver na lixeira será "Mover para a Lixeira" --}}
                    <button type="submit" class="btn btn-primary btn-sm float-left ml-1">Restaurar Produto</button>
                </form>
                @endif

                {{-- Formulário de excluir produto/mandar para Lixeira --}}
                <form action="{{ route('products.destroy', $product->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer apagar?')">
                    @csrf
                    @method('DELETE')
                    {{-- Se o produto estiver apagado, o botão mostrado será "Excluir", se não estiver na lixeira será "Mover para a Lixeira" --}}
                    <button type="submit" class="btn btn-danger btn-sm float-left ml-1">{{$product->trashed() ? 'Excluir' : 'Mover para a Lixeira'}}</button>
                </form>

            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection