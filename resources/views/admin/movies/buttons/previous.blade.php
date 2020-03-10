@if($previous)
   <a href="{{ route('admin.movies.show', [$previous]) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Previous Movie">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      View Previous      
   </a>
@endif
