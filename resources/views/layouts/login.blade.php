<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

   <!-- Script -->
   <script src="{{ asset('js/app.js') }}"></script>
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="/css/fontawesome/all.css"><!--load all styles 5.9.0-->
   <link rel="stylesheet" href="{{ asset('css/bootstrap_4/slate_b431.css') }}">
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/darkly.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/litera.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/sandstone.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/superhero.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/united.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/bootstrap-colors.css') }}">
   <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
   @yield('stylesheets')
</head>
<body>
   <div id="app">
      
      @include('layouts.navbar.navbar')
      @include('layouts.master.messages')

      <main class="container-fluid">
         {{-- <div id="" class="py-0 px-0"> --}}
            <div class="row py-0 px-2">
               <div class="col-sm-3 col-md-2 py-0 px-0">
                  @include('blocks.sessions')
                  {{-- @include('blocks.main_menu') --}}
                  {{-- @include('admin.blocks.admin_menu') --}}
                  @yield('left_column')
               </div>
               <div class="col-sm-6 col-md-8 py-0 px-2">
                  {{-- <example-component></example-component> --}}
                  @yield('content')
               </div>
               <div class="col-sm-3 col-md-2 py-0 px-0">
                  @yield('right_column')
               </div>
            </div>
         {{-- </div> --}}
      </main>
         
      <footer class="footer">
         @include('layouts.master.footer')
      </footer>
   </div>

<!-- Scripts -->
   
   <!-- Optional JavaScript -->
   @include('scripts.alertTimeout')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://www.google.com/recaptcha/api.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

   @include('scripts.datatables')
   @include('scripts.bulkButtons')
   @include('scripts.dateTimePicker')
   @include('scripts.tinyMCE')
   
   {{-- <script>
      $(function () {
         $('[data-toggle="tooltip"]').tooltip()
      });
   </script> --}}

   @yield('scripts')
   
</body>
</html>