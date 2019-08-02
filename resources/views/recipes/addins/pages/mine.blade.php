@auth
   <a href="{{ route('recipes.myRecipes') }}"
      class="btn btn-{{ $size }} btn-primary"
      title="My Recipes">
      <i class="{{ Config::get('buttons.mine') }}"></i>
   </a>
@endauth