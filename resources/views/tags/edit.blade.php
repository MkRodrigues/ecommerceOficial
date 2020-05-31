@extends('layouts.app')
@section('content')
<h2>Editar Tags</h2>
<form action="{{route('tags.update', $tags->id)}}" class="p-3 bg-white" method="POST">
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
        <label for="name">Nome da Tag:</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="Digite o nome da Tag" value="{{$tags->name}}">
    </div>
    <button type="submit" class="btn btn-success">Salvar Tag</button>
</form>
@endsection