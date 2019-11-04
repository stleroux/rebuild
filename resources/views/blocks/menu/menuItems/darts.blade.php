@if(checkPerm('dart_index'))
   <a href="#"
      class="list-group-item list-group-item-action p-1 {{ Route::is('darts.*') ? 'menu_active' : '' }} text-danger">
      <i class="fas fa-bullseye fa-fw"></i>
      Darts
   </a>
@endif
