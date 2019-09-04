@if($next)
   <a href="{{ route('blog.show', $next) }}"
      class="btn btn-{{$size}} btn-primary text-light col-sm-5"
      title="Next Blog">
      Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
