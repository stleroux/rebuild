<div class="card mb-3 p-0 m-0">

   <div class="card-header block_header p-2 m-0">
      <i class="fas fa-bars"></i>
      Main Menu
   </div>

   <div class="list-group">

      <a href="/"
         class="list-group-item list-group-item-action p-1 {{ Request::is('/') ? 'menu_active' : '' }}">
         <i class="fas fa-home fa-fw"></i>
         Home
      </a>

      @foreach (glob(base_path() . '/resources/views/blocks/menu/menuItems/*.blade.php') as $file)
          @include('blocks.menu.menuItems.' . basename(str_replace('.blade.php', '', $file)))
      @endforeach

   </div>

</div>
