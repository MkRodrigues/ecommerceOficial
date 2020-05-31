@extends('layouts.app')
@section('content')
<h2>Nova Tag</h2>
<form action="{{route('tags.store')}}" class="p-3 bg-white" method="POST">
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
    <div class="form-group">
        <label for="name">Nome da Tag:</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="Digite o nome da Tag" value="{{old('name')}}">
    </div>
    <button type="submit" class="btn btn-success">Criar Tag</button>
</form>
@endsection