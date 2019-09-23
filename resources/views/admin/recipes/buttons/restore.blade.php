{{-- @if(checkPerm('recipe_restore', $recipe))
   <button
      class="btn btn-sm btn-primary"
      type="submit"
      formaction="{{ route('recipes.restore', $recipe->id) }}"
      formmethod="GET"
      title="Restore Recipe">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </button>
@endif
 --}}
@if(checkPerm('recipe_delete'))
   <a href="{{ route('admin.recipes.restore', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Restore Recipe">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </a>
@endif
