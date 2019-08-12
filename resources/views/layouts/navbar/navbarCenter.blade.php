@auth
   <ul class="nav navbar-nav navbar-center">
      <li class="nav-item">
         Welcome {{ Auth::user()->first_name }}
      </li>
   </ul>
@endauth