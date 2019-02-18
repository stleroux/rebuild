{{-- <a href="{{ route($model.'s'.'.unpublish', $id) }}"
   class="{{ $type == 'menu' ? 'list-group-item list-group-item-action p-1' : 'btn btn-sm btn-outline-secondary px-1 py-0' }}"
   data-toggle="tooltip"
   data-placement="top"
   title="Unpublish">
   <i class="fas fa-download"></i>
   @if($type == 'menu')
      Unpublish
   @endif
</a>
 --}}
<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.unpublish', $id) }}"
   formmethod="GET"
   title="Unpublish">
   <i class="fas fa-download"></i>
   @if($type == 'menu')
      Unpublish
   @endif
</button>