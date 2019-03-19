{{-- <button onClick="window.print()" class="btn btn-sm btn-outline-secondary d-print-none">
   <i class="fas fa-print"></i>
</button>
 --}}

{{-- <a href="{{ route(str_plural($model).'.print', $id) }}"
   class="btn btn-sm btn-outline-secondary"
   title="Print Recipe">
   <i class="fas fa-print"></i>
</a> --}}

<a
   href="{{ route(str_plural($model).'.print', $id) }}"
   class="btn btn-sm btn-outline-secondary"
   type="button"
   title="Print {{ ucfirst($model) }}"
   data-toggle="modal"
   data-target="#printModal"
   data-link="{{ $id }}">
   <i class="fa fa-print"></i>
</a>
@include('recipes::frontend.modals.print')