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
            <div class="float-right">
                <a href="#" class="btn btn-primary btn-sm float-left ml-1" href="">Visualizar</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm float-left ml-1" href="">Editar</a>

                <form action="{{ route('categories.destroy', $category->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer apagar?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm float-left ml-1">Excluir</a>
                </form>

        </li>
        @endforeach
    </ul>
</div>
@endsection