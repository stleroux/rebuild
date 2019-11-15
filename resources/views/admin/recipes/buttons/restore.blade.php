@if(checkPerm('recipe_delete'))
   <a href="{{ route('admin.recipes.restore', $recipe->id) }}"
      class="btn b{{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Restore Recipe">
      <i class="{{ Config::get('buttons.restore') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
