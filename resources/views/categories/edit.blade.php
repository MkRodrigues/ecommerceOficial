@extends('layouts.app')
@section('content')
<h2>Editar Categoria</h2>
<form action="{{route('categories.update', $categories->id)}}" class="p-3 bg-white" method="POST">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach($errors->all() as $error)
            <li class="list-group-item text-danger">{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome da Categoria:</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="Digite o nome da Categoria" value="{{$category->name}}">
    </div>
    <button type="submit" class="btn btn-success">Salvar Categoria</button>
</form>
@endsection