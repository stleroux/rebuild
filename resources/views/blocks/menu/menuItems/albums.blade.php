@if(checkPerm('albums_index'))
   <a href="#"
      class="list-group-item list-group-item-action p-1 {{ Request::is('albums*') ? 'menu_active' : '' }} text-danger">
      <i class="fas fa-camera-retro fa-fw"></i>
      Albums
   </a>
@endif
