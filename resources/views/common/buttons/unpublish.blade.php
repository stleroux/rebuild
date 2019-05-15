@if(checkPerm($name.'_unpublish', $model))
   <a href="{{ route(str_plural($name).'.unpublish', $model->id) }}"
      class="btn btn-sm btn-outline-secondary"
      title="Unpublish {{ ucfirst($name) }}">
      <i class="fas fa-download"></i>
   </a>
@endif