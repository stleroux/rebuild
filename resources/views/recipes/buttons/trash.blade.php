@if(checkPerm('recipe_delete', $recipe))
   <a href="{{ route('recipes.trash', $recipe->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Trash Recipe">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
