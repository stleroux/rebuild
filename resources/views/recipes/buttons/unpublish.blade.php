{{-- @if(checkPerm($name.'_unpublish', $model))
   <a href="{{ route(str_plural($name).'.unpublish', $model->id) }}"
      class="btn btn-sm btn-outline-secondary"
      title="Unpublish {{ ucfirst($name) }}">
      <i class="fas fa-download"></i>
   </a>
@else
   <button class="btn btn-sm btn-outline-secondary" disabled="disabled">
      <i class="fas fa-download"></i>
   </button>
@endif
 --}}
@if(checkPerm('recipe_unpublish', $recipe))
   <a href="{{ route('recipes.unpublish', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Unpublish Recipe"><i class="{{ Config::get('buttons.publish') }} text-danger"></i></a>
@else
   {{-- <button class="btn btn-sm btn-outline-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button> --}}
   <a href="#"
      class="btn btn-{{ $size }} btn-primary disabled"
      title="Unpublish Recipe"><i class="{{ Config::get('buttons.publish') }} text-dark"></i></a>
@endif
