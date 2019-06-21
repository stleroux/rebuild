@if(checkPerm('recipe_future'))
   <a href="{{ route('recipes.future') }}" class="btn btn-sm btn-primary" title="Future Recipes">
      <i class="{{ Config::get('buttons.future') }}"></i>
   </a>
@endif