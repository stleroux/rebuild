@if(checkPerm('recipe_browse'))
   <a href="/help#{{$bookmark}}"
      target="_blank"
      class="btn btn-{{ $size }} btn-primary"
      title="Help">
      <i class="{{ Config::get('buttons.help') }}"></i>
   </a>
@endif
