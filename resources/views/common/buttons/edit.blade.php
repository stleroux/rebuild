@if(checkPerm('recipe.edit', $model))
   <a href="{{ route(str_plural($name).'.edit', $id) }}"
      class="btn btn-sm btn-outline-primary"
      title="Edit {{ ucfirst($name) }}">
      <i class="far fa-edit"></i>
   </a>
@endif