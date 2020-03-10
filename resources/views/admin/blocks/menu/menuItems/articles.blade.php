@if(checkPerm('article_browse'))
   <a href="{{ route('admin.articles.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.articles.*') ? 'menu_active' : '' }}">
      <i class="{{ Config::get('buttons.articles') }}"></i>
      Articles
   </a>
@endif
