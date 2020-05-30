@extends('layouts.app')
@section('content')
<h2>Editar Produto</h2>
<form action="{{route('products.update', $products->id)}}" class="p-3 bg-white" method="POST">
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
        <label for="name">Nome do Produto:</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="Digite o nome do Produto" value="{{$products->name}}">
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
        <input class="form-control" type="text" id="stock" name="stock" value="{{$products->stock}}">
    </div>
    <div class="form-group">
        <label for="price">Preço:</label>
        <input class="form-control" type="text" id="price" name="price" value="{{$products->price}}">
    </div>
    <div class="form-group">
        <label for="discount">Disconto:</label>
        <input class="form-control" type="text" id="discount" name="discount" value="{{$products->discount}}">
    </div>
    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea class="form-control" type="text" id="description" name="description" placeholder="Insira uma breve descrição sobre o produto">{{$products->description}}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Salvar Produto</button>
</form>
@endsection