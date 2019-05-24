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
      {{-- class="btn-outline-danger" --}}
      title="Trash Recipe"><i class="far fa-trash-alt text-danger"></i></a>
@else
   {{-- <button class="btn btn-sm btn-outline-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button> --}}
   <a href="#"
      class="btn-link disabled"
      title="Trash Recipe"><i class="far fa-trash-alt"></i></i></a>
@endif