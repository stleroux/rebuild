@if(checkPerm('category_browse'))
   <a href="{{ route('admin.categories.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Request::is('admin/categories*') ? 'menu_active' : '' }}">
      <i class="fa fa-sitemap fa-fw"></i>
      Categories
   </a>
@endif
