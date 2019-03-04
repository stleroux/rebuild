<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

   <!-- Styles -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
   {{-- <link href="{{ asset('css/bootstrap_4/slate.css') }}" rel="stylesheet"> --}}
   {{-- <link href="{{ asset('css/woodbarn.css') }}" rel="stylesheet"> --}}
   
</head>
<body>
   @include('layouts.master.navbar')
   <main class="container-fluid">
      
      <div id="app" class="py-2">
         <div class="row pt-0 pr-2 pl-2 pb-0">
            <div class="col-sm-3 col-md-2 pt-0 pr-0 pl-0 pb-0">
               {{-- @include('blocks.main_menu') --}}
               {{-- @include('blocks.admin_menu') --}}
               @yield('left_column')
            </div>
            <div class="col-sm-6 col-md-8 pt-0 pr-2 pl-2 pb-0">
               @yield('content')
            </div>
            <div class="col-sm-3 col-md-2 pt-0 pr-0 pl-0 pb-0">
               {{-- @include('blocks.login') --}}
               @yield('right_column')
            </div>
         </div>
      </div>
   </main>
      
   <footer class="footer fixed-bottom">
      @include('layouts.master.footer')
   </footer>

</div>
   
   <!-- Optional JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>

   <script>
      $(document).ready( function () {
         $('#datatable').DataTable(
            {
               "order": [],
               "stateSave": true,
               "pagingType": "full_numbers",
               "columnDefs": [ {
                  "targets"  : 'no-sort',
                  "orderable": false,
               }]
            }
         );
      });
   </script>
</body>
</html>