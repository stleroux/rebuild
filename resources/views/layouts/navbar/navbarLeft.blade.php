{{-- Left side --}}
@auth
   <ul class="nav navbar-nav">
      <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
      </li>

      <li class="nav-item dropdown">
         <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Modules <b class="caret"></b></a>
         <ul class="dropdown-menu">
            @include('layouts.navbar.partials.articles')
            @include('layouts.navbar.partials.categories')
            <li><a href="{{ route('comments.index') }}" class="dropdown-item">Comments</a></li>
            @include('layouts.navbar.partials.permissions')
            @include('layouts.navbar.partials.posts')
            @include('layouts.navbar.partials.recipes')
            <li><a href="{{ route('settings.index') }}" class="dropdown-item">Settings</a></li>
            <li><a href="{{ route('stats') }}" class="dropdown-item">Statistics</a></li>
            @include('layouts.navbar.partials.users')
         </ul>
      </li>
   </ul>
@endauth




{{-- <li class="nav-item dropdown">
<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Menu 2 <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="#" class="dropdown-item">Action</a></li>
<li><a href="#" class="dropdown-item">Another action</a></li>
<li><a href="#" class="dropdown-item">Something else here</a></li>
<li class="divider"></li>
<li><a href="#" class="dropdown-item">Separated link</a></li>
<li class="divider"></li>
<li><a href="#" class="dropdown-item">One more separated link</a></li>
<li class="dropdown-submenu">
<a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Dropdown1</a>
<ul class="dropdown-menu">
<li><a href="#" class="dropdown-item">Action</a></li>
<li class="dropdown-submenu">
<a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Dropdown2</a>
<ul class="dropdown-menu">
<li class="dropdown-submenu">
<a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Dropdown3</a>
<ul class="dropdown-menu">
<li><a href="#" class="dropdown-item">Action</a></li>
<li><a href="#" class="dropdown-item">Another action</a></li>
<li><a href="#" class="dropdown-item">Something else here</a></li>
<li class="divider"></li>
<li><a href="#" class="dropdown-item">Separated link</a></li>
<li class="divider"></li>
<li><a href="#" class="dropdown-item">One more separated link</a></li>
</ul>
</li>
</ul>
</li>
</ul>
</li>
</ul>
</li> --}}