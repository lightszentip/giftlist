<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @if( !App::environment(['Production','prd','PROD']))
        <link rel="stylesheet" href="{{ asset('css/ribbon.css') }}">
    @endif
</head>
<body class="font-sans antialiased">
@if( !App::environment(['Production','prd','PROD']))
    <div class="md:visible ribbon ribbon-top-left"><span>{{App::environment()}} Test</span></div>
@endif
<x-jet-banner/>


<div class="container-fluid px-0">
    @livewire('navigation-menu')

    <main class="flex-shrink-0">
        <div class="container">
            @if (isset($header))
                {{ $header }}
            @endif
            {{ $slot }}
        </div>
    </main>


</div>

@stack('modals')

@livewireScripts
</body>
</html>
