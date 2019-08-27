@if(checkPerm('recipe_new'))
   <a href="{{ route('recipes.newRecipes') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('recipes.newRecipes') ? 'secondary' : 'primary' }}"
      title="New Recipes">
      <i class="{{ Config::get('buttons.new') }}"></i>
   </a>
@endif