@extends('layouts.app')
@section('content')
<h2>Lista de Usuários</h2>
<div class="">
    <ul class="list-group">
        @foreach($users as $user)
        {{-- Se o usuário que estiver autenticado for o usuário admin, este não podera excluir seu próprio perfil --}}
        @if($user->id != auth()->user()->id)
        <li class="list-group-item">
            <span>{{$user->name}}</span>
            <span>({{$user->email}})</span>
            <div class="float-right">
                <form action="{{route('users.change-admin', $user->id)}}" class="d-inline" method="POST" onsubmit="return confirm('Este usuário será configurado com Administrador, continuar?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm float-left ml-1 {{ $user->isAdmin() ? 'btn-danger' : 'btn-primary' }}">
                        {{$user->isAdmin() ? 'Remover Admin' : 'Adicionar Admin'}}
                    </button>
                </form>
            </div>
        </li>
        @endif
        @endforeach
    </ul>
</div>
@endsection