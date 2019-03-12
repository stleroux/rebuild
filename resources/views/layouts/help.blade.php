<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

   <!-- Styles -->
   {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.css"/> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/slate.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('css/bootstrap-colors.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
   @yield('stylesheets')
</head>
<body>
   
   {{-- @include('layouts.master.navbar') --}}
   {{-- @include('layouts.master.messages') --}}

   <main class="container-fluid">
      <div id="app" class="py-0 px-0">
         <div class="row pt-0 pr-2 pl-2 pb-0">
            <div class="col-sm-3 col-md-2 pt-0 pr-0 pl-0 pb-0">
{{--              @include('blocks.main_menu') --}}
               @yield('left_column')
               Left Column
            </div>
            <div class="col-sm-9 col-md-10 py-0 px-2">
               @yield('content')
            </div>
            {{-- <div class="col-sm-3 col-md-2 py-0 px-0">
               @yield('right_column') --}}
{{--                @guest
                  @include('blocks.login')
               @else
                  @include('blocks.member')
               @endguest --}}
            {{-- </div> --}}
         </div>
      </div>
   </main>
      
{{--    <footer class="footer fixed-bottom">
      @include('layouts.master.footer')
   </footer> --}}

   <!-- Optional JavaScript -->
   {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.js"></script> --}}
   {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
   {{-- The above causes issues with dropdown menu requiring 2x clicks to open the first time --}}
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
   
   {{-- @yield('scripts') --}}

   
   {{-- @include('scripts.bulkButtons') --}}
   {{-- @include('scripts.dateTimePicker') --}}
   {{-- @include('scripts.datatables') --}}
   {{-- @include('scripts.tinyMCE') --}}
   
   {{-- <script>
      $(function () {
         $('[data-toggle="tooltip"]').tooltip()
      });
   </script> --}}
{{--    <script>
      $('#success-empty').hide();
      setTimeout(function() {
         $('#success-alert').remove();
         $('#success-empty').show();
      }, 5000); // <-- time in milliseconds
   </script> --}}

   
</body>
</html>