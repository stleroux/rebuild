{{-- @if(checkPerm($name.'_trash', $model))
   <a href="{{ route(str_plural($name) . '.trash', $model->id) }}"
      class="btn btn-sm btn-outline-danger"
      title="Trash {{ $name }}">
      <i class="far fa-trash-alt"></i>
   </a>
@else
   <button class="btn btn-sm btn-outline-danger" disabled="disabled">
      <i class="far fa-trash-alt"></i>
   </button>
@endif --}}


@if(checkPerm('recipe_trash', $recipe))
   <a href="{{ route('recipes.trash', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-danger"
      title="Trash Recipe"><i class="{{ Config::get('buttons.trash') }}"></i></a>
@else
   {{-- <button class="btn btn-sm btn-outline-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button> --}}
   <a href="#"
      class="btn btn-{{ $size }} btn-primary disabled"
      title="Trash Recipe"><i class="{{ Config::get('buttons.trash') }} text-dark"></i></i></a>
@endif
