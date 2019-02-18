<button
   class="btn btn-sm btn-outline-secondary"
   type="button"
   title="Recipes"
   onclick="window.location='{{ route($model.'s'.'.index') }}'">
   <i class="fab fa-apple"></i>
   @if($type == 'menu')
      Recipes
   @endif
</button>