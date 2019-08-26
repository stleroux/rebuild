@if(checkPerm('recipe_print'))
   <a href=""
      class="btn btn-{{ $size }} btn-primary d-print-none"
      onClick="window.print()">
      <i class="fa fa-print"></i>
   </a>
@endif
