@if(checkPerm('recipe_edit', $recipe))
   <a href="{{ route('recipes.edit', $recipe->id) }}"
      class="btn btn-sm btn-outline-primary"
      title="Edit Recipe">
      <i class="far fa-edit"></i>
   </a>
@else
   <button class="btn btn-sm btn-outline-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button>
@endif