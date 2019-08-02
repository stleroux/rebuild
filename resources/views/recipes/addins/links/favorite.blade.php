@auth
   @if(!$recipe->isFavorited())
      <a href="{{ route('recipes.favoriteAdd', $recipe->id) }}"
         class="btn btn-sm btn-primary px-0 py-1"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('recipes.favoriteRemove', $recipe->id) }}"
         class="btn btn-sm btn-primary px-0 py-1"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
      </a>
   @endif
@endauth