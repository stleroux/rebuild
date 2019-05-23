{{-- @if (false !== stripos($_SERVER['HTTP_REFERER'], "/"))
   <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-home"></i>
   </a>
@endif --}}

@if (false !== stripos($_SERVER['HTTP_REFERER'], "/permissions"))
   <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@endif

