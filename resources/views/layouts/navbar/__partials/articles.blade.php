{{-- Recipes --}}
{{-- @if(checkPerm('recipes.admin')) --}}
   <li class="dropdown-submenu">
      <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Articles</a>
      <ul class="dropdown-menu">
         <li>
            <a href="{{ route('articles.index') }}" class="dropdown-item">List All</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('articles.create') }}" class="dropdown-item">Add New</a>
         </li>
      </ul>
   </li>
{{-- @endif --}}