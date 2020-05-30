@extends('layouts.app')
@section('content')
<h2>Novo Produto</h2>
<form action="{{route('products.store')}}" class="p-3 bg-white" method="POST" enctype="multipart/form-data">
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
        <input class="form-control" type="text" id="name" name="name" placeholder="Digite o nome do Produto" value="{{old('name')}}">
    </div>

    <div class="form-group">
        <label for="name">Imagem:</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="stock">Estoque:</label>
        <input class="form-control" type="text" id="stock" name="stock" value="{{old('stock')}}">
    </div>
    <div class="form-group">
        <label for="price">Preço:</label>
        <input class="form-control" type="text" id="price" name="price" value="{{old('price')}}">
    </div>
    <div class="form-group">
        <label for="discount">Disconto:</label>
        <input class="form-control" type="text" id="discount" name="discount" value="{{old('discount')}}">
    </div>

    <div class="form-group">
        <label for="category">Categoria:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea class="form-control" type="text" id="description" name="description" placeholder="Insira uma breve descrição sobre o produto">{{old('description')}}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Criar Produto</button>
</form>
@endsection