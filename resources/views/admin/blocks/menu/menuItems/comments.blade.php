@if(checkPerm('comment_browse'))
   <a href="{{ route('admin.comments.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Request::is('admin/comments*') ? 'menu_active' : '' }}">
      <i class="fas fa-comments fa-fw"></i>
      Comments
   </a>
@endif
