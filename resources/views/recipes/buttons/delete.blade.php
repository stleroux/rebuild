@if(checkPerm('recipe_delete'))
   <a href="{{ route('recipes.delete', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Recipe">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
