<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @googlefonts
    <!-- Styles -->
    @livewireStyles
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @if( !App::environment(['Production','prd','PROD']))
        <link rel="stylesheet" href="{{ asset('css/ribbon.css') }}">
    @endif

</head>
<body class="text-center bg-light text-dark">
@if( !App::environment(['Production','prd','PROD']))
    <div class="invisible md:visible ribbon ribbon-top-left"><span>{{App::environment()}} Test</span></div>
    <div class="ribbon ribbon-top-right"><span>{{App::environment()}} Test</span></div>
@endif


{{ $slot }}
@livewireScripts
<script src="{{ mix('js/extras.js') }}"></script>

</body>
</html>
