<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    @if( !App::environment(['Production','prd','PROD']))
        <link rel="stylesheet" href="{{ asset('css/ribbon.css') }}">
    @endif
</head>
<body class="">


<div class="container-fluid px-0">
    @if( !App::environment(['Production','prd','PROD']))
        <div class="md:visible ribbon ribbon-top-left"><span>{{App::environment()}} Test</span></div>
    @endif
    <nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom">
        <!-- Navbar content -->
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ __('messages-page.app_name') }}</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    @if (Route::has('login'))

                        @auth
                            <div class="nav-item text-nowrap">
                                <a href="{{ url('/dashboard') }}"
                                   class="nav-link px-3">Dashboard</a>
                            </div>
                        @else
                            <div class="nav-item text-nowrap">
                                <a href="{{ route('login') }}"
                                   class="nav-link px-3">Log in</a>
                            </div>
                            @if (Route::has('register'))
                                <div class="nav-item text-nowrap">
                                    <a href="{{ route('register') }}"
                                       class="nav-link px-3">Register</a>
                                </div>
                            @endif
                        @endauth

                    @endif
                    <div class="nav-item text-nowrap form-check form-switch">
                        <label class="form-check-label" for="lightSwitch">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-brightness-high" viewBox="0 0 16 16">
                                <path
                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                            </svg>
                        </label>
                        <input class="form-check-input" type="checkbox" id="lightSwitch"/>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">{{ __('messages-page.welcome') }}</h1>
            <p class="lead">{{ __('messages-page.welcome_text') }}</p>
        </div>
    </main>


    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            @if( !App::environment(['Production','prd','PROD']))<p> Laravel
                v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}
                ) </p>
            @endif
            &copy; Tobi 2021-<?php echo date("Y"); ?>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
