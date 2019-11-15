@if(checkPerm('recipe_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="submit"
      formaction="{{ route('admin.recipes.restoreAll') }}"
      formmethod="POST"
      id="bulk-restore"
      title="Restore Selected"
      style="display:none;"
      onclick="return confirm('Are you sure you want to restore all these recipes?')">
      <i class="{{ Config::get('buttons.restore') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif