<ul class="navbar-nav ml-auto">

   @guest
      <li class="nav-item {{ Request::is('register*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ URL('/register') }}">Register Account</a>
      </li>

      <li class="nav-item {{ Request::is('login*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ URL('/login') }}">Login</a>
      </li>
   @endif

   @auth
      <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
   @endauth

   <li class="nav-item {{ Request::is('about*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ URL('/about') }}">About us</a>
   </li>
   
   <li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ URL('/contact') }}">Contact us</a>
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