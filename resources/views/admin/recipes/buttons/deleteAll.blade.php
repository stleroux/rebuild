@if(checkPerm('recipe_delete'))
   <button
      class="btn btn-{{ $size }} btn-primary border border-light text-warning"
      type="submit"
      formaction="{{ route('admin.recipes.deleteAll') }}"
      formmethod="POST"
      id="bulk-delete"
      title="Delete Selected"
      style="display:none"
      onclick="return confirm('Are you sure you want to permanently delete these recipes?')">
      <i class="far fa-trash-alt"></i>
   </button>
@endif
