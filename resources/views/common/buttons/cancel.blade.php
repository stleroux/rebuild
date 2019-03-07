@if((Session::get('pageName') === 'archive') || (Session::get('pageName') === 'home'))
   <a href="{{ URL::previous() }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a>
@elseif(Session::get('pageName') === 'index')
   <a href="{{ URL::previous() }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a>
@else
   <a href="{{ route(str_plural($model) . '.' . Session::get('pageName')) }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a>
@endif
