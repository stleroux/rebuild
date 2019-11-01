@if(checkPerm('admin_menu'))

   <div class="card mb-3 p-0 m-0">

      <div class="card-header block_header p-2 m-0">
         Admin Menu
      </div>

      <div class="list-group">
         @foreach (glob(base_path() . '/resources/views/admin/blocks/menu/menuItems/*.blade.php') as $file)
             @include('admin.blocks.menu.menuItems.' . basename(str_replace('.blade.php', '', $file)))
         @endforeach
      </div>

   </div>

@endif
