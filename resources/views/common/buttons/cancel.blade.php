@if((Session::get('pageName') === 'archive') || (Session::get('pageName') === 'home'))
   <a href="{{ URL::previous() }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a>
@endif

 {{-- Used  by recipes when displaying by category --}}
{{-- @if((Session::get('pageName', 'index')) && (Session::get('byCatName')))
   <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), Session::get('byCatName')) }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a> --}}
{{-- @endif --}}

{{-- @elseif((Session::get('pageName', 'index')) && (Session::get('byCatLetter')))
   <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), Session::get('byCatName')) }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a> --}}
{{-- @endif --}}

@if(Session::get('pageName') === 'index')
   {{-- <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), Session::get('byCatLetter')) }}" --}}
   <a href="{{ URL::previous() }}"
      class="btn btn-sm btn-outline-secondary"
      title="Back to previous page">
      <i class="fas fa-angle-double-left"></i>
      @if($type == 'menu')
         Cancel
      @endif
   </a>
@endif
