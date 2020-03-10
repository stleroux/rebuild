{{-- @if(checkPerm('movie_browse')) --}}
@auth
   <a href="{{ route('movies.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('movies.*') ? 'menu_active' : '' }}">
      <i class="{{ Config::get('buttons.movies') }}"></i>
      Movies
   </a>
@endauth
{{-- @endif --}}
