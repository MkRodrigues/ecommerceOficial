<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- Importação di JS de Select2 --}}
    {{-- Defer Executa o javascript depois que carregou a página --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script src="https://kit.fontawesome.com/61f35be86b.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- Importação do Css pacote Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    @yield('javascript')
</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                                    Categorias
                                </a>
                                <div class="dropdown-menu">
                                    @foreach(\App\Category::all() as $category)
                                    <a class="dropdown-item" href="{{ route('search-category', $category->id) }}">{{$category->name}}</a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                                    Tags
                                </a>
                                <div class="dropdown-menu">
                                    {{-- Busca todas as categorias da Classe Categorias e filtra elas por nome --}}
                                    @foreach(\App\Tag::all()->sortBy('name') as $tag)
                                    <a class="dropdown-item" href="{{ route('search-tag', $tag->id) }}">{{$tag->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        <form class="form-group m-0 w-50" action="{{route('search-product')}}">
                            <div class="input-group"><input type="text" class="form-control" placeholder="Digite o nome do prooduto" name="s">
                                <div class="input-group-append">
                                    <div class="input-group-text p-0">
                                        <button class="border-0" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.edit-profile') }}">Editar Perfil</a>
                                    @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('home') }}">Portal do Administrador</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i>{{Auth::user()->cart->products()->count()}}</a>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="py-4 container">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
            @endif
            @yield('content')
        </main>
        <footer class="container bg-primary text-white p-4">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h2 class="h4 ">Endereço</h2>
                    <adress>
                        Rua Lorem, ipsum dolor.386 <br>
                        Bairro Lorem, ipsum. <br>
                        Cep 000-00000 <br>
                        Telefone (11)00000-0000
                    </adress>
                </div>
                <div class="col-s-12 col-md-4">
                    <h2 class="h4 ">Horário de Funcionamento Loja Física</h2>
                    <ul class="list-unstyled pl-2">
                        <li>Segunda a Sexta: Das 9h às 20h</li>
                        <li>Sábado das 9h às 18h</li>
                    </ul>

                </div>
                <div class="col-sm-12 col-md-4">
                    <h2 class="h4 ">Mapa</h2>

                    <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-46.70502662658692%2C-23.626527592003423%2C-46.69498443603516%2C-23.61997114091615&amp;layer=mapnik" style="border: 1px solid black"></iframe>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>