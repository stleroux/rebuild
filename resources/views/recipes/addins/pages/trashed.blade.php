@if(checkPerm('recipe_trashed'))
   <a href="{{ route('recipes.trashed') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('recipes.trashed') ? 'secondary' : 'primary' }}"
      title="Trashed Recipes">
      <i class="{{ Config::get('buttons.trashed') }}"></i>
   </a>
@endif
