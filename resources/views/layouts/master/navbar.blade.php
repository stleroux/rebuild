<nav class="navbar navbar-expand sticky-top my-0 mx-0 py-0 pl-2 pr-0 navbar-dark bg-dark">
	
	<a class="navbar-brand" href="/">
		<h2 class="my-0 mx-0 py-0 px-0">{{ setting('app_name') }}</h2>
	</a>
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		{{-- Left side --}}

		{{-- Right Side --}}
		<ul class="navbar-nav ml-auto">
			
			@guest
				<li class="nav-item {{ Request::is('register*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ URL('/register') }}"><span style="font-weight: normal;">Register Account</span></a>
				</li>
			@endguest

			<li class="nav-item {{ Request::is('about*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ URL('/about') }}"><span style="font-weight: normal;">About us</span></a>
			</li>
			
			<li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ URL('/contact') }}"><span style="font-weight: normal;">Contact us</span></a>
			</li>
			
			{{-- <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#">Disabled</a>
			</li> --}}

		</ul>

	</div>
</nav>
