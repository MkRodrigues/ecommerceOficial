@extends('layouts.store')

@section('content')
<section class="container py-4">
    <div class="row">
        <div class="mx-auto col-md-10 text-center">
            <h2 class="text-uppercase">{{$title}}</h2>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, laborum!</p>
        </div>
    </div>
    <div class="row">
        @forelse($products as $product)
        <div class="mx-auto col-sm-10 col-md-6 col-lg-3">
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="">
            <span class="d-block h6 text-center mt-3">{{$product->name}}</span>
            <div class="text-center">
                <span class="text-muted old-price">{{$product->price()}}</span>
                <span>{{$product->discountPrice()}}</span>
            </div>
            <div class="text-center mt-3">
                <a class="btn btn-primary btn-sm" href="{{ route('show-product', $product->id) }}">Visualizar</a>
                <a class="btn btn-secondary btn-sm text-white" href="{{ route('show-product', $product->id) }}">Comprar</a>
            </div>
        </div>
        @empty
        <div class="mx-auto">
            <p>Não foi encontrado nenhum termo para a pesquisa <strong>{{request()->query('s')}}</strong></p>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $products->appends(['s' => request()->query('s')])->links() }}
    </div>
</section>
@endsection