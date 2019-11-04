@if($previous)
   <a href="{{ route('tests.show', [$previous]) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Previous Test">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      View Previous      
   </a>
@endif
