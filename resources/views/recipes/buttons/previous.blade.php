@if($previous)
   <a href="{{ route('recipes.show', [$previous, $byCatName]) }}"
      class="btn btn-{{$size}} btn-primary text-light"
      title="Previous Recipe">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      View Previous      
   </a>
@endif
