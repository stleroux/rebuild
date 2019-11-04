@if(checkPerm('permission_browse'))
   <a href="{{ route('admin.permissions.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.permissions.*') ? 'menu_active' : '' }}">
      <i class="fas fa-shield-alt fa-fw"></i>
      Permissions
   </a>
@endif
