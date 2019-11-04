@if(checkPerm('article_index'))
   <a href="{{ route('admin.articles.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.articles.*') ? 'menu_active' : '' }} text-warning">
      <i class="far fa-newspaper fa-fw"></i>
      Articles (WIP)
   </a>
@endif
