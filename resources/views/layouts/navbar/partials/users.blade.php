{{-- Recipes --}}
{{-- @if(checkPerm('recipes.admin')) --}}
   <li class="dropdown-submenu">
      <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Users</a>
      <ul class="dropdown-menu">
         <li>
            <a href="{{ route('users.index') }}" class="dropdown-item">List All</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('users.create') }}" class="dropdown-item">Add New</a>
         </li>
      </ul>
   </li>
{{-- @endif --}}