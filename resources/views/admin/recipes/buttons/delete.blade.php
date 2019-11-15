@if(checkPerm('recipe_delete'))
   <a href="{{ route('admin.recipes.delete', $recipe->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Delete Recipe">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
