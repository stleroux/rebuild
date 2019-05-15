@if(checkPerm($name.'_trash', $model))
   <a href="{{ route(str_plural($name) . '.trash', $model->id) }}"
      class="btn btn-sm btn-outline-danger"
      title="Trash {{ $name }}">
      <i class="far fa-trash-alt"></i>
   </a>
@endif