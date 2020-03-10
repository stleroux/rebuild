@if($next)
   <a href="{{ route('movies.show', $next) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Next Movie">
      View Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
