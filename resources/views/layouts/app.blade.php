<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ZD Pizzéria - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head')

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h4>Záródolgozat Pizzéria</h4>
                </a>
            <span class="navbar-text" style="text-align: center; width: 100%;">
                <span><strong>Tel.:</strong> +36/70-1234567</span>
                <span><strong>E-Mail:</strong> zdpizzeria@abc.xyz</span>
                <span><strong>Cím:</strong> 1000 Város, Nap utca 20.</span>
            </span>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <! -- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                @can('admin')
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Adminisztráció <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('admin.')}}">Irányítópult</a>
                                <a class="dropdown-item" href="{{route('admin.orders.index')}}">Rendelések</a>
                                <a class="dropdown-item" href="{{route('admin.users.index')}}">Felhasználók</a>
                                <a class="dropdown-item" href="{{route('admin.etels.index')}}">Ételek</a>
                                <a class="dropdown-item" href="{{route('admin.roles.index')}}">Szerepek</a>
                            </div>
                        </li>
                    </ul>
                @endcan

                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <h5><a class="nav-link" href="{{ route('login') }}">Bejelentkezés</a></h5>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <h5><a class="nav-link" href="{{ route('register') }}">Regisztráció</a></h5>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->vezeteknev }} {{ Auth::user()->keresztnev }} <span
                                    class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{route('profile.index')}}">Profil</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Kilépés
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="justify-content-center d-flex">
        <nav class="justify-content-center navbar navbar-light bg-white shadow-sm" style="width: max-content;">
            <h5><a class="nav-link" href="/">Főoldal</a></h5>
            <h5><a class="nav-link" href="{{route('etlap.index')}}">Étlap</a></h5>
            <h5><a class="nav-link" href="{{route('kosar.index')}}">Kosár (<?php if(session()->get('kosar') == null) echo 0; else echo count(session()->get('kosar')); ?>)</a></h5>
        </nav>
    </div>

    <main class="py-4">
        <div class="card-body">
            @include('partials.alerts')
            @yield('content')
        </div>
    </main>

</div>
</body>
</html>

