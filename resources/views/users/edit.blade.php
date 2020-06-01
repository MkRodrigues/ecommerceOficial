@extends('layouts.app')
@section('content')
<h2>Editar Perfil</h2>
<form action="{{route('users.update-profile') }}" class="p-3 bg-white" method="POST">
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
        <label for="name">Nome:</label>
        <input class="form-control" type="text" name="name" placeholder="Digite seu nome" value="{{$user->name}}">
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input class="form-control" type="text" name="email" placeholder="Digite seu nome" value="{{$user->email}}">
    </div>
    <div class="form-group">
        <label for="password">Senha (Alteração Opcional)</label>
        <input class="form-control" type="text" id="name" name="password" placeholder="Digite uma nova senha (caso não alterado, sua senha permanecerá a mesma)">
    </div>
    <button type="submit" class="btn btn-success">Atualizar Perfil</button>
</form>
@endsection