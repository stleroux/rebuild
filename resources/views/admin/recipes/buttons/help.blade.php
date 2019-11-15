@if(checkPerm('recipe_browse'))
   <a href="/help#{{$bookmark}}"
      target="_blank"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
      title="Help">
      <i class="{{ Config::get('buttons.help') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
