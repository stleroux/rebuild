@if($previous)
   <a href="{{ route('articles.show', $previous) }}"
      class="btn btn-{{$size}} btn-primary text-light"
      title="Previous Article">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      View Previous      
   </a>
@endif
