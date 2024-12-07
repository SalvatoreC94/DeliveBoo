<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite('resources/js/app.js') <!-- Questo include il JS, ma potrebbe esserci un altro JS incluso più in basso -->
</head>

<body>
    <!-- Navbar principale -->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">Template</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link 3</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                            <li>
                                <a href="{{ env('FRONTEND_URL', 'http://localhost:5174') }}"
                                    class="btn btn-link ms-auto no-underline">
                                    Home
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>




    <!-- Adobe Font - Solo se necessario -->
    <link rel="stylesheet" href="https://use.typekit.net/lyi7tbf.css"> <!-- Rimuovere se non utilizzi questo font -->


    <!-- Navbar duplicata: probabile errore o codice non necessario -->
    <!-- Questa seconda navbar è simile alla prima, ma è nascosta grazie alla classe d-none. Potresti non aver bisogno di questa seconda navbar -->

    <!-- Seconda navbar (probabilmente duplicata e nascosta) -->
    <header>
        <nav class="navbar shadow navbar-expand-lg d-none">
            <div class="container ">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        @auth
                            <li class="nav-item">
                                <!-- Logo in questa navbar non sarà visibile perché la navbar è nascosta con d-none -->
                                <img class="logo-nav" src="{{ asset('../storage/images/Logo-deliveBoo.svg') }}"
                                    alt="">
                            </li>
                        @endauth
                    </ul>

                    @auth
                        <!-- Form per il logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="logout button-menu">
                                Log Out
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    <!-- Fine della seconda navbar -->

    <!-- Contenuto principale -->
    <main class="">
        <div class="container">
            @yield('main-content') <!-- Qui andranno inseriti i contenuti dinamici della pagina -->
        </div>
    </main>

</body>

</html>
