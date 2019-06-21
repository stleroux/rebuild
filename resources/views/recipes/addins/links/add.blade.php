@if(checkPerm('recipe_create'))
   <a href="{{ route('recipes.create') }}"
      class="btn btn-sm btn-success"
      title="Add Recipe">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif