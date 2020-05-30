@extends('layouts.app')
@section('content')
<h2>Novo Produto</h2>
<form action="{{route('products.store')}}" class="p-3 bg-white" method="POST">
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
        <label for="name">Nome do Produto:</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="Digite o nome do Produto">
    </div>
    {{-- <div class="custom-file mb-3" style="display:none">
        <input type="text" class="custom-file-input" id="customFile" value="null">
        <label class="custom-file-label" for="customFile" name="image">Insira uma imagem</label>
    </div> --}}

    <div class="form-group" style="display:none">
        <label for="name">Imagem:</label>
        <input type="text" class="form-control" name="image" value="null">
    </div>

    <div class="form-group">
        <label for="stock">Estoque:</label>
        <input class="form-control" type="text" id="stock" name="stock">
    </div>
    <div class="form-group">
        <label for="price">Preço:</label>
        <input class="form-control" type="text" id="price" name="price" value="0">
    </div>
    <div class="form-group">
        <label for="discount">Disconto:</label>
        <input class="form-control" type="text" id="discount" name="discount" value="0">
    </div>
    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea class="form-control" type="text" id="description" name="description" placeholder="Insira uma breve descrição sobre o produto"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Criar Produto</button>
</form>
@endsection