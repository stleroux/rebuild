@if(checkPerm('recipe_restore'))
   <button
      class="btn btn-{{ $size }} btn-outline-secondary"
      type="submit"
      formaction="{{ route('recipes.restoreAll') }}"
      formmethod="POST"
      id="bulk-restore"
      title="Restore Selected"
      style="display:none;"
      onclick="return confirm('Are you sure you want to restore all these recipes?')">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </button>
@endif