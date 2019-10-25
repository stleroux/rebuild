<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="/css/fontawesome/all.css"><!--load all styles 5.9.0-->
</head>
<body>
   
   <div id="frontend" style="background-color: lightgreen">
      <div class="container-fluid border">
         
         <div class="row">
            <div>Navbar</div>
         </div>

         <div class="row">

            <div class="col-2 border">Left Menu</div>
            
            <div class="col-8 px-1 border">
               <div class="card p-0">Title</div>
               <div class="card p-0">Alphabet</div>
            </div>
            
            <div class="col-2 border">Right Menu</div>

         </div>

         <div class="row">
            <div>Footer</div>
         </div>

      </div>
   </div>


<hr>


   <div id="backend" style="background-color: lightblue">
      <div class="container-fluid border">
         
         <div class="row" style="background-color: yellow">
            <div>Navbar</div>
         </div>

         <div class="row">
            <div>Messages</div>
         </div>

         <div class="row">
            <div class="col-2 px-0 border">Left Menu</div>
            <div class="col-8 px-1 border">
               <div class="card p-0">Title</div>
               <div class="card p-0">Alphabet</div>
               <div class="card p-0">CONTENT DATAGRID</div>
            </div>
            <div class="col-2 border btn-group-vertical p-0">
               <a href="#" class="btn btn-sm btn-primary">Back</a>
               <a href="#" class="btn btn-sm btn-secondary">Unpublish Selected</a>
               <a href="#" class="btn btn-sm btn-warning">Trash Selected</a>
               <a href="#" class="btn btn-sm btn-danger">Delete Selected</a>
               <a href="#" class="btn btn-sm btn-info">Publish Selected</a>
               <a href="#" class="btn btn-sm btn-dark">Restore Selected</a>
            </div>
         </div>
         <div class="row" style="background-color: yellow">
            <div>Footer</div>
         </div>
      </div>
   </div>

   <!-- Script -->
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://www.google.com/recaptcha/api.js"></script>
</body>
</html>