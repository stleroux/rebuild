@if(checkPerm('recipe_create'))
   <a href="{{ route('recipes.create') }}"
      class="btn btn-{{ $size }} btn-success"
      title="Add Recipe"
      type="button">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif