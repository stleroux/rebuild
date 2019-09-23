@if(checkPerm('recipe_read'))
   <a href="{{ route('recipes.print', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Print Recipe">
      <i class="{{ Config::get('buttons.print') }}"></i>
   </a>
@endif
