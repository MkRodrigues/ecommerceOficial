@extends('layouts.store')
@section('css')
<style>
    .banner {
        min-height: 400px;
        background: url('https://via.placeholder.com/1100x400');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .old-price {
        text-decoration: line-through;
    }
</style>
@endsection

@section('content')
<div id="banner" class="banner d-flex align-items-center px-4">
    <div class="">
        <span class="h2 d-block m- text-capitalize">Toda nossa loja está em promoção</span>
        <span class="h1 d-block mb-3 text-uppercase font-weight-bold">Em promoção</span>
        <a href="#" class="btn btn-primary">Veja nossos produtos</a>
    </div>
</div>

<section class="container py-5">
    <div class="row">
        <div class="mx-auto col-md-10 text-center">
            <h2 class="text-uppercase">Nossos produtos</h2>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
        <div class="mx-auto col-sm-10 col-md-6 col-lg-3">
            <div class="">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="">
                <span class="d-block h6 text-center mt-3">{{$product->name}}</span>
                <div class="text-center">
                    <span class="text-muted old-price">{{$product->price()}}</span>
                    <span>{{$product->discountPrice()}}</span>
                </div>
                <div class="text-center mt-3">
                    <a class="btn btn-primary btn-sm" href="#">Visualizar</a>
                    <a class="btn btn-secondary btn-sm text-white" href="">Comprar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection