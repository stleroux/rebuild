@if(checkPerm('dart_browse'))
   <a href="{{ route('darts.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('darts.*') ? 'menu_active' : '' }}">
      <i class="fas fa-bullseye fa-fw"></i>
      Dart Keeper
   </a>
@endif
