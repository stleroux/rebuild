@if($next)
   <a href="{{ route('articles.show', $next) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Next Article">
      View Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
