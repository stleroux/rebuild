@if(checkPerm('recipe_read'))
   <a href="{{ route('recipes.print', $recipe->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
      title="Print Recipe">
      <i class="{{ Config::get('buttons.print') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
