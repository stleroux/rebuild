@if($next)
   <a href="{{ route('recipes.show', [$next, $byCatName]) }}"
      class="btn btn-{{$size}} btn-primary text-light"
      title="Next Recipe">
      View Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
