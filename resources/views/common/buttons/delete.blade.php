<a href="{{ route(str_plural($name) . '.delete', $model->id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Delete {{ ucfirst($name) }}">
   <i class="fas fa-trash-alt"></i>
</a>