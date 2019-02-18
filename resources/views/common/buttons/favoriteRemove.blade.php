<button
   type="button"
   class="btn btn-sm btn-outline-secondary"
   title="Remove Favorite"
   onclick="window.location='{{ route('recipes.favoriteRemove', $recipe->id) }}'">
   <i class="far fa-thumbs-down"></i>
   @if($type == 'menu')
      Remove Favorite
   @endif
</button>