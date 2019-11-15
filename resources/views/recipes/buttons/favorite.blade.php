{{-- Used in Recipe index page to add butotn to each recipe card --}}
@if(checkPerm('recipe_browse'))
   @if(!$recipe->isFavorited())
      <a href="{{ route('recipes.favoriteAdd', $recipe->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
         Add {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('recipes.favoriteRemove', $recipe->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
         Remove {{ $btn_label ?? '' }}
      </a>
   @endif
@endif
