@if(checkPerm('recipe_trashed'))
   <a href="{{ route('recipes.trashed') }}" class="btn btn-{{ $size }} btn-primary" title="Trashed Recipes">
      <i class="{{ Config::get('buttons.trashed') }}"></i>
   </a>
@endif