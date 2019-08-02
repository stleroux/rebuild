<button
   class="btn btn-{{ $size }} btn-primary border border-light text-warning"
   type="submit"
   formaction="{{ route('recipes.trashAll') }}"
   formmethod="POST"
   id="bulk-trash"
   title="Trash Selected"
   style="display:none;"
   onclick="return confirm('Are you sure you want to trash these recipes?')">
   <i class="{{ Config::get('buttons.trash') }}"></i>
</button>
