@auth
   <ul class="nav navbar-nav navbar-center">
      <li class="nav-item">
         Welcome {{ Auth::user()->profile->first_name }}
      </li>
   </ul>
@endauth