<button
   class="btn btn-sm btn-outline-success"
   type="button"
   title="Add {{ ucfirst($model) }}"
   onclick="window.location='{{ route($model.'s'.'.create') }}'">
   <i class="fa fa-plus-square"></i>
   @if($type == 'menu')
      Add {{ ucfirst($model) }}
   @endif
</button>