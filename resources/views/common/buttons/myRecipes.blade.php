<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.myRecipes') }}"
   formmethod="GET"
   title="{{ ucfirst($model) }}s">
   <i class="fas fa-dot-circle"></i>
   @if($type == 'menu')
      My Recipes
   @endif
</button>