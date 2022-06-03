<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/utensils-solid.svg') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RestaurApp</title>

    {{-- BOOTSTRAP --}}
    <link href="{{ asset('bootstrap-5.1.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- JS --}}
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    {{-- FONTAWESOME --}}
    <link href="{{ asset('fontawesome-free-6.1.1-web/css/all.css') }}" rel="stylesheet">
    {{-- CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    RestaurApp <i class="fa-solid fa-utensils"></i>
                </a>
                <div class="container">
                    <div class="row justify-content-center">
                        <main class="tituloCabecera">
                            @yield('cabecera')
                        </main>
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item" hidden>
                                    <a class="nav-link"
                                        href="{{ route('register') }}">{{ __('Registrar Usuario') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    {{-- INICIO COOKIES --}}

    <div class="row" id="cookieBanner">
        <div class="col-md-5 col-sm-12 colBanner">
            <div class="p-3 pb-4 bannerContenido text-white">
                <div class="row">
                    <div class="col-10">
                        <h4>Permitir Cookies</h4>
                    </div>
                </div>
                <p>&#x1F36A; Esta web utiliza cookies para asegurarte una mejor experiencia en nuestra web. &#x1F36A;
                </p>
                <button id="botonCookie" type="button" class="btn btn-light">Aceptar
                    Cookies</button>
            </div>
        </div>
    </div>
    {{-- FIN COOKIES --}}
</body>

</html>
