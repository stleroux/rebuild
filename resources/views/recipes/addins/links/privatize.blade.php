@if(checkPerm('recipe_private', $recipe))
   @if($recipe->personal == 0)
      <a href="{{ route('recipes.privatize', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-secondary"
         title="Make Private">
         <i class="{{ Config::get('buttons.public') }} text-danger"></i>
      </a>
   @else
      <a href="{{ route('recipes.publicize', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-secondary"
         title="Make Public">
         <i class="{{ Config::get('buttons.public') }} text-success"></i>
      </a>
   @endif
@endif