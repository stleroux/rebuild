@if(checkPerm('admin_menu'))

   <div class="card mb-3 p-0 m-0">

      <div class="card-header block_header p-2 m-0">
         <i class="fas fa-cog"></i>
         Admin Menu
      </div>

      <div class="list-group">

         <a href="{{ route('admin.dashboard') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('admin.dashboard*') ? 'menu_active' : '' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            Dashboard
         </a>

         @foreach (glob(base_path() . '/resources/views/admin/blocks/menu/menuItems/*.blade.php') as $file)
             @include('admin.blocks.menu.menuItems.' . basename(str_replace('.blade.php', '', $file)))
         @endforeach

      </div>

   </div>

@endif
