{{-- @if((Session::get('pageName') === 'archive') || (Session::get('pageName') === 'home'))
   <a href="{{ URL::previous() }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
   </a>
@elseif(Session::get('pageName') === 'recipes_index')
   <a href="{{ route('recipes.index', 'all') }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
   </a>
@else
   <a href="{{ route(str_plural($model) . '.' . Session::get('pageName')) }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
   </a>
@endif --}}

   <a onclick="window.history.back();"
      class="btn btn-{{ $size }} btn-primary d-print-none text-light"
      title="Back to previous page">
      <i class="fas fa-fw fa-angle-double-left"></i>
   </a>