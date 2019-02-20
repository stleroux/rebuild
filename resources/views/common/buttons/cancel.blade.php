@if((Session::get('pageName') === 'archive') || (Session::get('pageName') === 'home'))
   <button
      class="btn btn-sm btn-outline-secondary"
      type="submit"
      title="Back to previous page"
      formaction="{{ URL::previous() }}"
      {{-- formmethod="GET" --}}>
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </button>
@else
   <button
      class="btn btn-sm btn-outline-secondary"
      type="submit"
      title="Back to previous page"
      formaction="{{ route($model.'s.'.Session::get('pageName')) }}"
      formmethod="GET">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </button>
@endif

