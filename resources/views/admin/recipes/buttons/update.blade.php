@if(checkPerm('recipe_edit', $recipe))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info"
      type="submit"
      formmethod="POST"
      title="Update Recipe">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
