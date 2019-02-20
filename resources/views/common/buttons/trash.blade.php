{{-- <a href="{{ route($model.'s'.'.trash', $id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Trash">
   <i class="far fa-trash-alt"></i>
   @if($type == 'menu')
      Trash
   @endif
</a> --}}


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