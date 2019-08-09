@if(checkPerm('recipe_edit', $recipe))
   <a href="{{ route('recipes.edit', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Recipe"><i class="{{ Config::get('buttons.edit') }}"></i></a>
@endif
