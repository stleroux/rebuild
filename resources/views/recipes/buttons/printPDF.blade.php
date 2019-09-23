@if(checkPerm('recipe_read'))
   <a href="{{ route('recipes.printPDF', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Print Recipe to PDF">
      <i class="{{ Config::get('buttons.pdf') }}"></i>
      PDF
   </a>
@endif
