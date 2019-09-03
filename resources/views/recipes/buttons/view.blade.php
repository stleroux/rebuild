{{-- @if(checkPerm('recipe_show')) --}}
   <a href="{{ route('recipes.view', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Recipe">
      <i class="far fa-eye"></i>
   </a>
{{-- @endif --}}
