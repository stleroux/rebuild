@if(checkPerm('recipe_edit', $recipe))
   <a href="{{ route('recipes.edit', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-info"
      title="Edit Recipe"><i class="{{ Config::get('buttons.edit') }}"></i></a>
@else
   <a href="{{ route('recipes.edit', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary disabled"
      title="Edit Recipe"><i class="{{ Config::get('buttons.edit') }} text-dark"></i></a>
@endif
