@if(checkPerm('recipe_read'))
   <a href=""
      class="btn btn-{{ $size }} btn-primary d-print-none"
      onClick="window.print()">
      <i class="{{ Config::get('buttons.print') }}"></i>
      Print
   </a>
@endif
