<button
   class="btn btn-sm btn-primary border border-light text-warning"
   type="submit"
   formaction="{{ route('recipes.deleteAll') }}"
   formmethod="POST"
   id="bulk-delete"
   title="Delete Selected"
   style="display:none"
   onclick="return confirm('Are you sure you want to permanently delete these recipes?')">
   <i class="far fa-trash-alt"></i>
</button>