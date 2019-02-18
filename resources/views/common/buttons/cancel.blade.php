@if(Session::get('pageName', 'archive'))
   <a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
      <i class="fas fa-angle-double-left"></i>
      Cancel
   </a>
@else
   <a href="{{ route($model.'s.'. Session::get('pageName')) }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
      <i class="fas fa-angle-double-left"></i>
      Cancel
   </a>
@endif