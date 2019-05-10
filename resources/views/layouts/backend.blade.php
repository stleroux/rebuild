<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

   <!-- Scripts -->
   {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
   {{-- Removed above because it interferes with DataTable --}}
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

   <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">

   <!-- Font Awesome -->
   {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> --}}
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

   <!-- Styles -->
   {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/slate.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('css/bootstrap-colors.css') }}" />
   <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
   <link rel="stylesheet" href="{{ asset('css/backendMenu.css') }}">   
   <style type="text/css" media="screen"> @import url("menuh.css"); </style>
   <!--[if lt IE 7]>
      <style type="text/css" media="screen">
         #menuh{float:none;}
         body{behavior:url(csshover.htc); font-size:100%;}
         #menuh ul li{float:left; width: 100%;}
         #menuh a{height:1%;font:bold 0.7em/1.4em arial, sans-serif;}
      </style>
   <![endif]-->
   @yield('stylesheets')
</head>
<body>
   
{{-- pageName : {{ Session::get('pageName') }}<br />byCatName : {{ Session::get('byCatName') }}<br />byCatLetter : {{ Session::get('byCatLetter') }} --}}
   
   @include('layouts.master.navbar')
   {{-- @if(checkPerm('admin_menu')) --}}
      @include('layouts.backendMenu')
   {{-- @endif --}}
   @include('layouts.master.messages')

   <main class="container-fluid">
      <div id="app" class="py-0 px-0">
         <div class="row py-0 pr-2 pl-2">
            <div class="col-sm-2 p-0">
               {{-- @if(!checkPerm('admin_menu')) --}}
                  @yield('left_column')
               {{-- @endif --}}
            </div>
            <div class="col-sm-10 py-0 px-2">
               @yield('content')
            </div>
            {{-- <div class="col-sm-2 p-0">
               @yield('right_column')
            </div> --}}
         </div>
      </div>
   </main>

{{--    @if(!checkPerm('admin_menu'))
      <main class="container-fluid">
         <div id="app" class="py-0 px-0">
            <div class="row pt-0 pr-2 pl-2 pb-0">
               <div class="col-sm-3 col-md-2 pt-0 pr-0 pl-0 pb-0">
                  @yield('left_column')
               </div>
               <div class="col-sm-9 col-md-10 py-0 px-2">
                  @yield('content')
               </div>
            </div>
         </div>
      </main>
   @else
      <main class="container-fluid">
         <div id="app" class="py-0 px-0">
            <div class="row pt-0 pr-2 pl-2 pb-0">
               <div class="col py-0 px-2">
                  @yield('content')
               </div>
            </div>
         </div>
      </main>
   @endif --}}
      
   <footer class="footer fixed-bottom">
      @include('layouts.master.footer')
   </footer>

   <!-- Optional JavaScript -->
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>
   {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
   {{-- The above causes issues with dropdown menu requiring 2x clicks to open the first time --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   
   @yield('scripts')

   
   @include('scripts.bulkButtons')
   @include('scripts.dateTimePicker')
   @include('scripts.datatables')
   @include('scripts.tinyMCE')
   
   {{-- <script>
      $(function () {
         $('[data-toggle="tooltip"]').tooltip()
      });
   </script> --}}
   <script>
      $('#success-empty').hide();
      setTimeout(function() {
         $('#success-alert').remove();
         $('#success-empty').show();
      }, 5000); // <-- time in milliseconds
   </script>

   
</body>
</html>