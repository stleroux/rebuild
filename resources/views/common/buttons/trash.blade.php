@if(checkPerm($name.'_trash', $model))
   <a href="{{ route(str_plural($name) . '.trash', $model->id) }}"
      class="btn btn-sm btn-outline-danger"
      title="Trash {{ $name }}">
      <i class="far fa-trash-alt"></i>
   </a>
@else
   <button class="btn btn-sm btn-outline-danger" disabled="disabled">
      <i class="far fa-trash-alt"></i>
   </button>
@endif
