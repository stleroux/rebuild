@if(checkPerm('recipe_add'))
   <a href="{{ route('admin.recipes.create') }}"
      class="btn btn-{{ $size }} btn-success"
      title="Add Recipe"
      type="button">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif