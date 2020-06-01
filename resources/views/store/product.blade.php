@extends('layouts.store')

@section('content')
<header>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="{{ route('search-category', $product->category->id) }}">{{$product->category->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$product->name }}</li>
        </ol>
    </nav>
</header>
<section class="container py-4">
    <div class="row">

        <div class="col-4 mx-auto text-center">
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="">
        </div>

        <div class="col-7 mx-auto text-center">
            <h2 class="text-uppercase">{{$product->name}}</h2>
            <p class="text-muted">{{$product->description}}</p>
            <div class="text-center">
                <span class="text-muted old-price">{{$product->price()}}</span>
                <span>{{$product->discountPrice()}}</span>
            </div>
            <div class="text-center mt-3">
                <a class="btn btn-primary btn-large" href="">Comprar</a>
            </div>
            <div class="text-center mt-5 ">
                <h3>Tags</h3>
                @foreach($product->tags as $tag)
                <a class="btn btn-secondary btn-sm" href="{{route('search-tag', $tag->id)}}">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection