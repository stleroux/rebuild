<a href="{{ route($model.'s'.'.makePrivate', $id) }}"
   class="{{ $type == 'menu' ? 'list-group-item list-group-item-action p-1' : 'btn btn-sm btn-outline-danger px-1 py-0' }}"
   {{-- {{ @if($type == 'menu') }}
      class="list-group-item list-group-item-action p-1 bg-success"
   {{ @else }}
      class="btn btn-sm btn-outline-danger px-1 py-0"
   {{ @endif }} --}}
   >
   <i class="far fa-trash-alt"></i>
   Make Private
</a>