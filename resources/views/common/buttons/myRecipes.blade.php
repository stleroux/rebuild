<button
   class="btn btn-sm btn-outline-secondary"
   type="button"
   title="My Recipes"
   onclick="window.location='{{ route($model.'s'.'.myRecipes') }}'">
   <i class="fas fa-dot-circle"></i>
   @if($type == 'menu')
      My Recipes
   @endif
</button>