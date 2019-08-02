@auth
   <a href="{{ route('recipes.myPrivateRecipes') }}"
      class="btn btn-{{ $size }} btn-primary"
      title="My Private Recipes">
      <i class="{{ Config::get('buttons.private') }}"></i>
   </a>
@endauth