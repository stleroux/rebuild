@if(checkPerm('movie_index'))
   <a href="{{ route('admin.movies.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.movies.*') ? 'menu_active' : '' }}">
      <i class="{{ Config::get('buttons.movies') }}"></i>
      Movies
   </a>
@endif
