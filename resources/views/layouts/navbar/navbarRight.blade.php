<ul class="navbar-nav ml-auto">

   @guest
      <li class="nav-item {{ Route::is('register*') ? 'active' : '' }}">
         <a class="nav-link p-2" href="{{ URL('/register') }}">
            <i class="fas fa-plus-circle"></i>
            Register Account
         </a>
      </li>

      <li class="nav-item {{ Route::is('login*') ? 'active' : '' }}">
         <a class="nav-link p-2" href="{{ URL('/login') }}">
            <i class="fas fa-sign-in-alt"></i>
            Login
         </a>
      </li>
   @endif

   @auth
      <li class="nav-item {{ Route::is('admin.dashboard*') ? 'active' : '' }}">
         <a class="nav-link p-2" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
         </a>
      </li>
   @endauth

   <li class="nav-item {{ Route::is('about*') ? 'active' : '' }}">
      <a class="nav-link p-2" href="{{ URL('/about') }}">
         <i class="fas fa-question-circle"></i>
         About us
      </a>
   </li>
   
   <li class="nav-item {{ Route::is('contact*') ? 'active' : '' }}">
      <a class="nav-link p-2" href="{{ URL('/contact') }}">
         <i class="fas fa-bullhorn"></i>
         Contact us
      </a>
   </li>
   
   <!-- Dropdown -->
   @auth
   <li class="nav-item dropdown
      {{ Route::is('profile.edit', 'profile.show') ? 'active' : '' }}
      {{ Route::is('resetPassword.edit') ? 'active' : '' }}
   ">
      <a class="nav-link p-2 dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
         <i class="fas fa-user-cog"></i>
         My Account
      </a>
      <div class="dropdown-menu dropdown-menu-right">
         <a href="{{ route('profile.show', Auth::User()->id) }}"
            class="dropdown-item {{ Route::is('profile.edit', 'profile.show') ? 'active' : '' }} p-2">
            <i class="fas fa-user-circle"></i>
            My Profile
         </a>

         <a href="{{ route('resetPassword.edit', Auth::user()->id) }}"
            class="dropdown-item {{ Route::is('resetPassword.edit') ? 'active' : '' }} p-2">
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
      <a class="nav-link p-2 disabled" href="#">Disabled</a>
   </li> --}}

</ul>