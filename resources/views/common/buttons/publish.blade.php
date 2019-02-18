{{-- <a href="{{ route($model.'s'.'.publish', $id) }}"
   class="{{ $type == 'menu' ? 'list-group-item list-group-item-action p-1' : 'btn btn-sm btn-outline-secondary px-1 py-0' }}"
   title="Publish">
   <i class="fas fa-upload"></i>
   @if($type == 'menu')
      Publish
   @endif
</a>
 --}}
<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.publish', $id) }}"
   formmethod="GET"
   title="Publish">
   <i class="fas fa-upload"></i>
   @if($type == 'menu')
      Publish
   @endif
</button>