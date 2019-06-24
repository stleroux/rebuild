<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}"></script>
   
   {{-- Removed above because it interferes with DataTable --}}
   <script src="https://www.google.com/recaptcha/api.js"></script>

   <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="/css/fontawesome/all.css">
   <!--load all styles 5.9.0-->

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
   <link rel="stylesheet" type="text/css" href="css/DataTables/datatables.min.css"/>
   <link rel="stylesheet" href="{{ asset('css/bootstrap_4/slate.css') }}">
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-colors.css') }}" /> --}}
   {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}
   @yield('stylesheets')
</head>
<body>
   
   @include('layouts.navbar.navbar')
   @include('layouts.master.messages')

   <main class="container-fluid">
      <div id="app" class="py-0 px-0">
         <div class="row py-0 px-2">
            <div class="col-sm-3 col-md-2 py-0 px-0">
               @yield('left_column')
            </div>
            <div class="col-sm-9 col-md-10 py-0 px-2 mb-2">
               @yield('content')
            </div>
         </div>
      </div>
   </main>
      
   <footer class="footer">
      @include('layouts.master.footer')
   </footer>

   <!-- Optional JavaScript -->
   {{-- <script type="text/javascript" src="js/jquery/jquery-3.4.1.js"></script> --}}
   {{-- <script type="text/javascript" src="js/DataTables/datatables.min.js"></script> --}}

   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>   

   
@include('scripts.datatables')
   @include('scripts.bulkButtons')
   @include('scripts.dateTimePicker')
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
   @yield('scripts') 
   
</body>
</html>