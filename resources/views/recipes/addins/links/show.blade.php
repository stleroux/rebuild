@if(checkPerm('recipe_show'))
   <a href="{{ route('recipes.show', ($recipe->id ? $recipe->id : $archive->id)) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Recipe">
      <i class="far fa-eye"></i>
   </a>
@endif
