{{-- Recipes --}}
{{-- @if(checkPerm('recipes.admin')) --}}
   <li class="dropdown-submenu">
      <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Categories</a>
      <ul class="dropdown-menu">
         <li>
            <a href="{{ route('categories.index') }}" class="dropdown-item">List All</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('categories.create') }}" class="dropdown-item">Add New</a>
         </li>
      </ul>
   </li>
{{-- @endif --}}