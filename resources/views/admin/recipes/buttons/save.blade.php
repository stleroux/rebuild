@if(checkPerm('recipe_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success"
      type="submit"
      formmethod="POST"
      title="Save Recipe">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
