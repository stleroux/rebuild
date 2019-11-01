@if(checkPerm('settings'))
   <a href="{{ route('admin.settings.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.settings.*') ? 'menu_active' : '' }}">
      <i class="fas fa-cog fa-fw"></i>
      Site Settings
   </a>
@endif
