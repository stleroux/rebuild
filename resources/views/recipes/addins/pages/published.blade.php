@if(checkPerm('recipe_published'))
   <a href="{{ route('recipes.published') }}" class="btn btn-{{ $size }} btn-primary" title="Published Recipes">
      <i class="{{ Config::get('buttons.published') }}"></i>
   </a>
@endif
