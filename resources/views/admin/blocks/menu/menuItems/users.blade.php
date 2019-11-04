@if(checkPerm('user_browse'))
   <a href="{{ route('admin.users.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.users.*') ? 'menu_active' : '' }}">
      <i class="fas fa-users fa-fw"></i>
      Users
   </a>
@endif
