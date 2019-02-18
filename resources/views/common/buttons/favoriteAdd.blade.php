<button
   type="button"
   class="btn btn-sm btn-outline-secondary"
   title="Add Favorite"
   onclick="window.location='{{ route('recipes.favoriteAdd', $recipe->id) }}'">
   <i class="far fa-thumbs-up"></i>
   @if($type == 'menu')
      Add Favorite
   @endif
</button>