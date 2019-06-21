@if(checkPerm('recipe_publish', $recipe))
   <a href="{{ route('recipes.unpublish', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Unpublish Recipe"><i class="{{ Config::get('buttons.publish') }} text-danger"></i></a>
@else
   <a href="#"
      class="btn btn-{{ $size }} btn-primary disabled"
      title="Unpublish Recipe"><i class="{{ Config::get('buttons.publish') }} text-dark"></i></a>
@endif
