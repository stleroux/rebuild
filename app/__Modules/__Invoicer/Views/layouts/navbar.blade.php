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
				{{-- <ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@guest
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
								{{ Auth::user()->username }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu">
								<li>
									@role('Admin')
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
				</ul> --}}

			</div>
		</nav>