@if(checkPerm('recipe_read'))
   <a href="{{ route('recipes.printPDF', $recipe->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
      title="Print Recipe to PDF">
      <i class="{{ Config::get('buttons.pdf') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
