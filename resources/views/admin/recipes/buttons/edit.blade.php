@if(checkPerm('recipe_edit', $recipe))
   <a href="{{ route('admin.recipes.edit', $recipe->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Edit Recipe">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
