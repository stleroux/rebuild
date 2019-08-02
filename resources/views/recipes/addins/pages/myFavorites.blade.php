@auth
   <a href="{{ route('recipes.myFavorites') }}"
      class="btn btn-sm btn-primary p-1 py-1"
      title="My Favorites">
      <i class="{{ Config::get('buttons.favorites') }}"></i>
   </a>
@endauth