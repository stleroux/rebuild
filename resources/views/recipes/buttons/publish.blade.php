{{-- @if(checkPerm('recipes_publish', $recipe))
   <button
      class="btn btn-sm btn-secondary"
      type="submit"
      formaction="{{ route('recipes.publish', $recipe->id) }}"
      formmethod="GET"
      title="Publish">
      <i class="fas fa-upload"></i>
   </button>
@endif --}}

<a href="{{ route('recipes.publish', $recipe->id) }}"
   class="btn btn-{{ $size }} btn-primary"
   title="Publish Recipe">
   <i class="{{ Config::get('buttons.publish') }} text-success"></i>
</a>
      