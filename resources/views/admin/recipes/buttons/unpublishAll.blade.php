@if(checkPerm('recipe_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-danger"
      type="submit"
      formaction="{{ route('admin.recipes.unpublishAll') }}"
      formmethod="POST"
      id="bulk-unpublish"
      title="Unpublish Selected"
      style="display:none;"
      onclick="return confirm('Are you sure you want to unpublish these recipes?')">
      <i class="{{ Config::get('buttons.publish') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
