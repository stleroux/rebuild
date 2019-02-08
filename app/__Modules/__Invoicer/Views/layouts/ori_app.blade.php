<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="/images/invoice.png">

		<title>Invoicer</title>

		<!-- Bootstrap core CSS -->
		{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
		{{-- <link href="{{ asset('css/bootstrap_4/bootstrap.css') }}" rel="stylesheet"> --}}

		<!-- Custom styles for this template -->
		<link href="{{ asset('css/invoicer.css') }}" rel="stylesheet">
		<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
		{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> --}}
	</head>

	<body>

		{{-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> --}}
		<nav class="navbar navbar-dark bg-primary navbar-expand-md fixed-top">
			<a class="navbar-brand" href="/">TheWoodBarn.ca</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item {{ (Request::is('invoicer') ? 'active' : '') }}">
						{{-- <a class="nav-link" href="#">Invoicer <span class="sr-only">(current)</span></a> --}}
						<a class="nav-link" href="{{ url('/invoicer') }}">Invoicer</a>
					</li>
					<li class="nav-item {{ (Request::is('invoicer/dashboard') ? 'active' : '') }}">
						<a class="nav-link" href="{{ route('invoicer.dashboard') }}">Dashboard</a>
					</li>
					<li class="nav-item {{ (Request::is('invoicer/ledger*') ? 'active' : '') }}">
						<a class="nav-link" href="{{ route('invoicer.ledger') }}">Ledger</a>
					</li>
					<li class="nav-item {{ (Request::is('invoicer/invoices*') ? 'active' : '') }}">
						<a class="nav-link" href="{{ route('invoicer.invoices') }}">Invoices</a>
					</li>
					<li class="nav-item {{ (Request::is('invoicer/clients*') ? 'active' : '') }}">
						<a class="nav-link" href="{{ route('invoicer.clients') }}">Clients</a>
					</li>
					<li class="nav-item {{ (Request::is('invoicer/products*') ? 'active' : '') }}">
						<a class="nav-link" href="{{ route('invoicer.products') }}">Products</a>
					</li>
				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@guest
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu">
								<li>
									@role('Admin') {{-- Laravel-permission blade helper --}}
                            	<a href="#"><i class="fa fa-btn fa-unlock"></i>Admin</a>
                           @endrole

									<a href="{{ route('logout') }}"
										onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
										Logout
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
					@endguest
				</ul>

			</div>
		</nav>

		@if(Session::has('flash_message'))
		   <div class="container">      
		       <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
		       </div>
		   </div>
		@endif 

		<div class="row">
		   <div class="col-md-8 col-md-offset-2">              
		       {{-- @include ('errors.list') --}} {{-- Including error file --}}
		   </div>
		</div>

		<main role="main" class="container-fluid">
			@yield('content')
		</main>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="../../assets/js/vendor/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
