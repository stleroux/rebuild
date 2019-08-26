@if($next)
   <a href="{{ route('blog.show', $next) }}"
      class="btn btn-{{$size}} btn-primary text-light"
      title="Next Blog">
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
