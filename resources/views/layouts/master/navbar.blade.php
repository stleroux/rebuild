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

			@auth
				<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('dashboard') }}"><span style="font-weight: normal;">Dashboard</span></a>
				</li>
			@endauth

         @guest
            <li class="nav-item {{ Request::is('login*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ URL('/login') }}"><span style="font-weight: normal;">Login</span></a>
            </li>
         @endif

			<li class="nav-item {{ Request::is('about*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ URL('/about') }}"><span style="font-weight: normal;">About us</span></a>
			</li>
			
			<li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}">
				<a class="nav-link" href="{{ URL('/contact') }}"><span style="font-weight: normal;">Contact us</span></a>
			</li>
			
	<!-- Dropdown -->
   @auth
   <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
         My Account
      </a>
      <div class="dropdown-menu dropdown-menu-right">
      	<a href="{{ route('profile.show', Auth::User()->id) }}"
            class="dropdown-item {{ Route::is('profile.edit', 'profile.show') ? 'active' : '' }} p-2">
            <i class="fas fa-user-circle"></i>
            My Profile
         </a>

         <a href="{{ route('profile.resetPwd', Auth::user()->id) }}"
            class="dropdown-item {{ Route::is('profile.resetPwd') ? 'active' : '' }} p-2">
            <i class="fas fa-user-lock"></i>
            Reset My Password
         </a>

         <a href="{{ route('logout') }}"
            class="dropdown-item p-2"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            {{ __('Logout') }}
         </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
         </form>
      </div>
   </li>
   @endauth
			{{-- <li class="nav-item">
				<a class="nav-link disabled" href="#">Disabled</a>
			</li> --}}

		</ul>

	</div>
</nav>
