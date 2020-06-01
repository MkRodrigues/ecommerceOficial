@extends('layouts.app')
@section('javascript')
<script>
    window.onload = function() {
            $('.select2').select2();
        };
</script>
@endsection
@section('content')
<h2>Editar Produto</h2>
<form action="{{route('products.update', $products->id)}}" class="p-3 bg-white" method="POST" enctype="multipart/form-data">
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

    <div class="form-group">
        <label for="image">Imagem:</label>
        <input type="file" class="form-control" name="image">
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
        <label for="name">Categoria:</label>
        <select name="category_id" id="" class="form-control">
            @foreach($categories as $category)
            <option value="{{$category->id}}" @if($category->id == $products->category_id) selected @endif>
                {{$category->name}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="category">Tags:</label>
        <select name="tags[]" class="form-control select2" multiple>
            @foreach($tags as $tag)
            {{-- a função hasTag criada na Model Produto verifica quais tags foram selecionadas na criacão do respectivo produto e seleciona quais foram escolhidas --}}
            <option value="{{$tag->id}}" {{$products->hasTag($tag->id) ? 'selected' : ''}}>
                {{$tag->name}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea class="form-control" type="text" id="description" name="description" placeholder="Insira uma breve descrição sobre o produto">{{$products->description}}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Salvar Produto</button>
</form>
@endsection