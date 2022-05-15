<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="{{ asset('js/masonry.pkgd.min.js') }}" defer></script>
    <script type="module" src="{{ asset('js/imagesloaded.pkgd.min.js') }}" defer></script>
    <script type="module" src="{{ asset('js/vue.js') }}" defer></script>
    <script type="module" src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ url('images/logo.png') }}">
</head>
<body>
    <div id="app">
        <nav style="background-color: #688f64;" class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home.main') }}">
                    <img style="width: 6em" src="{{ asset('/images/logoletters.png') }}" alt="">
                </a>
                

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                    </div>
                        @else
                        
                        <div class="row">
                            <div class="col-4 m-0 p-0 align-middle d-flex align-items-center justify-content-center " style="width: 2em;">
                                <a class="d-flex align-items-center justify-content-center" href="{{ route( 'post.create') }}">
                                    <span style="color: black;" class="material-icons">&#xe145;</span>
                                </a>
                            </div>
                            <div class="col-4 m-0 p-0 d-flex aligns-items-center justify-content-center">
                                <img class="avatar" src="{{ route('image.getavatar', ['filename'=>Auth::user()->image]) }}">
                            </div>
                            <div class="col-4 m-0 p-0">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span class="fw-bold">{{ Auth::user()->nick }}</span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        
                                        <a class="dropdown-item" href="{{route('user.profile', ['id' => Auth::user()->id])}}">
                                            {{_('Veure perfil')}}
                                        </a>

                                        <a class="dropdown-item" href="{{route('user.edit')}}">
                                            {{_('Editar usuari')}}
                                        </a>
    
                                        <a class="dropdown-item" href="{{route('user.editpass')}}">
                                            {{_('Canviar contrasenya')}}
                                        </a>
    
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </div>
                        </div>
                            
                        @endguest
                    </ul>
                
            </div>
        </nav>

        <main style="background-color: #e8e8e8; min-height: 41.5em;" class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="card">
                            <div class="card-header headercustom custom-title"><h3 class="m-0">@yield('title')</h3></div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="text-center text-lg-start" style="background-color: #688f64">
        <div class="text-center p-3">
            Copyright © 2022 "<a class="text-dark" href="{{route('home.main')}}">Receptarium</a>" una empresa de Eric Roca Inc. Tots els drets reservats.

        </div>
      </footer>
</body>
</html>
