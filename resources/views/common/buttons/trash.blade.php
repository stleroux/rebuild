<a href="{{ route(str_plural($model) . '.trash', $id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Trash {{ $model }}">
   <i class="far fa-trash-alt"></i>
   @if($type == 'menu')
      Trash {{ $model }}
   @endif
</a>

{{-- 
<button
   class="btn btn-sm btn-outline-danger"
   type="submit"
   formaction="{{ route($model.'s'.'.publish', $id) }}"
   formmethod="GET"
   title="Trash {{ ucfirst($model) }}">
   <i class="far fa-trash-alt"></i>
   @if($type == 'menu')
      Trash {{ ucfirst($model) }}
   @endif
</button>

<a href="{{ route(str_plural($model) . '.delete', $id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Delete {{ $model }}">
   <i class="fas fa-trash-alt"></i>
   @if($type == 'menu')
      Delete {{ $model }}
   @endif
</a> --}}