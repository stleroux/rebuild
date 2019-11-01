@if(checkPerm('post_browse'))
   <a href="{{ route('admin.posts.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Request::is('admin/posts*') ? 'menu_active' : '' }}">
      <i class="far fa-newspaper fa-fw"></i>
      Posts
   </a>
@endif
