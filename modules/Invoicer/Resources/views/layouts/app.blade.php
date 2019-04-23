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
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap_4/bootstrap.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/invoicer.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        @include('invoicer::layouts.navbar')
        
        
        <main class="py-5">
            @include('invoicer::layouts.flash')
            <div class="container-fluid">

                @yield('content')
            </div>
        </main>

        <footer>
            @include('invoicer::layouts.footer')
        </footer>
    </div>

    <script>
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    </script>
</body>

</html>
