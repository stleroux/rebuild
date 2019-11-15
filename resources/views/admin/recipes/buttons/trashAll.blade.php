@if(checkPerm('recipe_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary border border-light text-warning"
      type="submit"
      formaction="{{ route('admin.recipes.trashAll') }}"
      formmethod="POST"
      id="bulk-trash"
      title="Trash Selected"
      style="display:none;"
      onclick="return confirm('Are you sure you want to trash these recipes?')">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
