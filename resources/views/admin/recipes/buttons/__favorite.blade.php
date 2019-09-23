@if(checkPerm('recipe_browse'))
   @if(!$recipe->isFavorited())
      <a href="{{ route('admin.recipes.favoriteAdd', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-primary"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('recipes.favoriteRemove', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-primary"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
      </a>
   @endif
@endif
