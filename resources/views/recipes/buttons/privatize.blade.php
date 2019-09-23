@if(checkPerm('recipe', $recipe))
   @if($recipe->personal == 0)
      <a href="{{ route('recipes.privatize', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-primary"
         title="Make Private">
         <i class="{{ Config::get('buttons.public') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('recipes.publicize', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-primary"
         title="Make Public">
         <i class="{{ Config::get('buttons.private') }} text-danger"></i>
      </a>
   @endif
@endif
