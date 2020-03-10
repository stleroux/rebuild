{{-- @if(checkPerm('article_browse')) --}}
@auth
   <a href="{{ route('articles.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('articles.*') ? 'menu_active' : '' }}">
      <i class="{{ Config::get('buttons.articles') }}"></i>
      Articles
   </a>
@endauth
{{-- @endif --}}
