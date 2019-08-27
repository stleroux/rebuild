{{-- Recipes --}}
{{-- @if(checkPerm('recipes.admin')) --}}
   <li class="dropdown-submenu">
      <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Recipes</a>
      <ul class="dropdown-menu">
         <li>
            <a href="{{ route('recipes.published') }}" class="dropdown-item">Published Recipes</a>
         </li>
         <li>
            <a href="{{ route('recipes.unpublished') }}" class="dropdown-item">Unpublished Recipes</a>
         </li>
         <li>
            <a href="{{ route('recipes.future') }}" class="dropdown-item">Future Recipes</a>
         </li>
         <li>
            <a href="{{ route('recipes.newRecipes') }}" class="dropdown-item">New Recipes</a>
         </li>
         <li>
            <a href="{{ route('recipes.trashed') }}" class="dropdown-item">Trashed Recipes</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('recipes.myRecipes') }}" class="dropdown-item">My Recipes</a>
         </li>
         <li>
            <a href="{{ route('recipes.myPrivateRecipes') }}" class="dropdown-item">My Private Recipes</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('recipes.create') }}" class="dropdown-item">Add a Recipe</a>
         </li>
      </ul>
   </li>
{{-- @endif --}}