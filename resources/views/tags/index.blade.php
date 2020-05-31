@extends('layouts.app')
@section('content')
<h2>Lista de Tags</h2>
<div class="d-flex mb-2 justify-content-end">
    <a class="btn btn-success right" href="{{route('tags.create')}}">Nova Tag</a>
</div>
<div class="">
    <ul class="list-group">
        @foreach($tags as $tag)
        <li class="list-group-item">
            {{-- Chama a função de relacionamento Products definida na Model Produtos, e retorna a quantidade de produtos que usam determinada tag através da função count() --}}
            <span>{{$tag->name}} ({{ $tag->products()->count() }})</span>
            <div class="float-right">

                @if(!$tag->trashed())
                <a href="#" class="btn btn-primary btn-sm float-left ml-1" href="">Visualizar</a>
                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm float-left ml-1">Editar</a>

                @else
                <form action="{{ route('restore-tags.update', $tag->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer restaurar este dado?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary btn-sm float-left ml-1">Restaurar Categoria</button>
                </form>

                @endif
                <form action="{{ route('tags.destroy', $tag->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Você tem certeza que quer apagar?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm float-left ml-1">{{$tag->trashed() ? 'Excluir' : 'Mover para a Lixeira'}}</button>
                </form>

        </li>
        @endforeach
    </ul>
</div>
@endsection