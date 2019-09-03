@if($next)
   <a href="{{ route('recipes.show', $next) }}"
      class="btn btn-{{$size}} btn-primary text-light col-sm-5"
      title="Next Recipe">
      View Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
