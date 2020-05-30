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
            <span>{{$product->name}}</span>
            <div class="float-right">
                <a class="btn btn-primary btn-sm float-left ml-1" href="">Visualizar</a>
                <a class="btn btn-warning btn-sm float-left ml-1" href="">Editar</a>
                <a class="btn btn-danger btn-sm float-left ml-1" href="">Excluir</a>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection