@if(checkPerm($name.'_edit', $model))
   <a href="{{ route(str_plural($name).'.edit', $model->id) }}"
      class="btn btn-sm btn-outline-primary"
      title="Edit {{ ucfirst($name) }}">
      <i class="far fa-edit"></i>
   </a>
@else
   <a href="#" class="btn btn-sm btn-outline-primary">
      
   </a>
@endif