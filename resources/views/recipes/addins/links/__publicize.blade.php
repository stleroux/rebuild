{{-- 
   <button
      class="btn btn-sm btn-secondary"
      type="submit"
      formaction="{{ route('recipes.makePublic', $recipe->id) }}"
      formmethod="GET"
      title="Make Public">
      <i class="far fa-eye"></i>
   </button> --}}
@auth
   @if(checkPerm('recipe_private', $recipe))
      <a href="{{ route('recipes.publicize', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-secondary"
         title="Make Public"><i class="{{ Config::get('buttons.public') }}"></i>
      </a>
   @endif
@endauth