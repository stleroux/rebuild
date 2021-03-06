@if(checkPerm('recipe_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary border border-light text-warning"
      type="submit"
      formaction="{{ route('admin.recipes.deleteAll') }}"
      formmethod="POST"
      id="bulk-delete"
      title="Delete Selected"
      style="display:none"
      onclick="return confirm('Are you sure you want to permanently delete these recipes?')">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
