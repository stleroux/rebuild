{{-- <a href="{{ route($model.'s'.'.edit', $id) }}"
   class="{{ $type == 'menu' ? 'list-group-item list-group-item-action p-1' : 'btn btn-sm btn-outline-primary px-1 py-0' }}"
   data-toggle="tooltip"
   data-placement="top"
   title="Edit">
   <i class="far fa-edit"></i>
   @if($type == 'menu')
      Edit
   @endif
</a> --}}

<button
   type="button"
   class="btn btn-sm btn-outline-primary"
   title="Edit {{ ucfirst($model) }}"
   onclick="window.location='{{ route($model.'s'.'.edit', $id) }}'">
   <i class="far fa-edit"></i>
   @if($type == 'menu')
      Edit {{ ucfirst($model) }}
   @endif
</button>