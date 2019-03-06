<a href="{{ route(str_plural($model) . '.delete', $id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Delete {{ ucfirst($model) }}">
   <i class="fas fa-trash-alt"></i>
   @if($type == 'menu')
      Delete {{ ucfirst($model) }}
   @endif
</a>