@if($previous)
   <a href="{{ route('blog.show', $previous) }}"
      class="btn btn-{{$size}} btn-primary text-light"
      title="Previous Blog">
      <i class="{{ Config::get('buttons.previous') }}"></i>
   </a>
@endif
