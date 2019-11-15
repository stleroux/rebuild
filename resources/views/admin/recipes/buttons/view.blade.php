@if(checkPerm('recipe_read'))
   <a href="{{ route('admin.recipes.show', $recipe->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Show Recipe">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
