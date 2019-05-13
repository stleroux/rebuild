{{-- Recipes --}}
{{-- @if(checkPerm('recipes.admin')) --}}
   <li class="dropdown-submenu">
      <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Permissions</a>
      <ul class="dropdown-menu">
         <li>
            <a href="{{ route('permissions.index') }}" class="dropdown-item">View All</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('permissions.create') }}" class="dropdown-item">Add New</a>
         </li>
      </ul>
   </li>
{{-- @endif --}}