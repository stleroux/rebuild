@auth
   <a href="{{ route('recipes.myFavorites') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('recipes.myFavorites') ? 'secondary' : 'primary' }}"
      title="My Favorites">
      <i class="{{ Config::get('buttons.favorites') }}"></i>
   </a>
@endauth