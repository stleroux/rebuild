@if($next)
   <a href="{{ route('admin.projects.show', $next) }}"
      class="btn btn-{{ $size }} btn-primary text-light col-sm-5"
      title="Next Project">
      {{-- Next --}}
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
