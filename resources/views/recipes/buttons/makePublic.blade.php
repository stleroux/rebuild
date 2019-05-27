{{-- 
   <button
      class="btn btn-sm btn-secondary"
      type="submit"
      formaction="{{ route('recipes.makePublic', $recipe->id) }}"
      formmethod="GET"
      title="Make Public">
      <i class="far fa-eye"></i>
   </button> --}}

@if(checkPerm('recipe_makePublic', $recipe))
   <a href="{{ route('recipes.makePublic', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-secondary"
      title="Make Public"><i class="{{ Config::get('buttons.public') }}"></i>
   </a>
@endif