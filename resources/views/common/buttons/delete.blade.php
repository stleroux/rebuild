<a href="{{ route(str_plural($model) . '.delete', $id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Delete {{ $model }}">
   <i class="fas fa-trash-alt"></i>
   @if($type == 'menu')
      Delete {{ $model }}
   @endif
</a>