@if(checkPerm('article_browse'))
   <a href="{{ route('articles.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('articles.*') ? 'menu_active' : '' }} text-warning">
      <i class="far fa-newspaper fa-fw"></i>
      Articles (WIP)
   </a>
@endif
