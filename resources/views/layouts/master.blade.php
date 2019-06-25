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

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="/css/fontawesome/all.css"><!--load all styles 5.9.0-->
   <link rel="stylesheet" href="{{ asset('css/bootstrap_4/slate_b431.css') }}">
   <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">
   {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-colors.css') }}" /> --}}
   <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
				<div class="col-sm-6 col-md-8 py-0 px-2">
					@yield('content')
				</div>
				<div class="col-sm-3 col-md-2 py-0 px-0">
					@yield('right_column')
				</div>
			</div>
		</div>
	</main>
		
	<footer class="footer">
		@include('layouts.master.footer')
	</footer>

	<!-- Optional JavaScript -->
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
	<script>
		$('#success-empty').hide();
		setTimeout(function() {
			$('#success-alert').remove();
			$('#success-empty').show();
		}, 5000); // <-- time in milliseconds
	</script>

	
</body>
</html>