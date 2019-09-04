@if($previous)
   <a href="{{ route('projects.show', $previous) }}"
      class="btn btn-{{ $size }} btn-primary text-light col-sm-5"
      title="Previous Project">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      Previous
   </a>
@endif
