@if(checkPerm('recipe_print'))
   <a href="{{ route('recipes.printPDF', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Print Recipe to PDF">
      <i class="{{ Config::get('buttons.print') }}"></i>
   </a>
@endif
