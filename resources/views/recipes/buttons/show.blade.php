@if(checkPerm('recipe_show', $recipe))
   <a href="{{ route('recipes.show', ($recipe->id ? $recipe->id : $archive->id)) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Show Recipe">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
