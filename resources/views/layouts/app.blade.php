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

                    </ul>

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
                                <a class="dropdown-item" href="/">Portal Site</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

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
            @auth
            {{-- Chama a função isAdmin definida na Model de Usuário e verifica se o usuário em questão é admin --}}
            {{-- Se ele for admin, o bloco abaixo é exibido, senão ocultado --}}
            @if(auth()->user()->isAdmin())
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{route('products.index')}}">Produtos</a></li>
                        <li class="list-group-item"><a href="{{route('categories.index')}}">Categorias</a></li>
                        <li class="list-group-item"><a href="{{route('tags.index')}}">Tags</a></li>
                        <li class="list-group-item"><a href="{{route('users.index')}}">Usuários</a></li>
                    </ul>
                    <ul class="list-group mt-3">
                        <li class="list-group-item"><a href="{{route('trashed-products.index')}}">Lixeira Produtos</a></li>
                        <li class="list-group-item"><a href="{{route('trashed-categories.index')}}">Lixeira Categorias</a></li>
                        <li class="list-group-item"><a href="{{route('trashed-tags.index')}}">Lixeira Tags</a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
            @else
            {{-- Usuário logado, porém não administrador --}}
            @yield('content')
            @endif
            @else
            @yield('content')
            @endauth
        </main>
    </div>
</body>

</html>