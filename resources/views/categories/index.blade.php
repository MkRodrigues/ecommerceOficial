@extends('layouts.app')
@section('content')
<h2>Lista de Categorias</h2>
<div class="d-flex mb-2 justify-content-end">
    <a class="btn btn-success right" href="{{route('categories.create')}}">Nova Categoria</a>
</div>
<div class="">
    <ul class="list-group">
        @foreach($categories as $category)
        <li class="list-group-item">
            <span>{{$category->name}}</span>
            <a class="btn btn-primary btn-sm float-right ml-1" href="">Visualizar</a>
            <a class="btn btn-warning btn-sm float-right ml-1" href="">Editar</a>
            <a class="btn btn-danger btn-sm float-right" href="">Excluir</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection