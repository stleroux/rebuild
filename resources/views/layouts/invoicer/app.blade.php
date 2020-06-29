<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome/all.css">
    <!--load all styles 5.9.0-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap_4/bootstrap.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/invoicer.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>

<body>
    <div id="app">

        @include('layouts.invoicer.navbar')
        
        
        <main class="py-5">
            @include('layouts.invoicer.flash')
            <div class="container-fluid">

                @yield('content')
            </div>
        </main>

        <footer>
            @include('layouts.invoicer.footer')
        </footer>
    </div>

    <script>
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    </script>
</body>

</html>
