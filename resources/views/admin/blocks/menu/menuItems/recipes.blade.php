@if(checkPerm('recipe_browse'))
   <a href="{{ route('admin.recipes.index') }}"
      class="list-group-item list-group-item-action p-1 {{
      (Route::is('admin.recipes*')) ? 'menu_active' : '' }}">
      <i class="fab fa-apple fa-fw"></i>
      Recipes
   </a>
@endif
