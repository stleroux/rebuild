@if(checkPerm('invoicer_index'))
   <a href="{{ route('invoicer.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('invoicer.*') ? 'menu_active' : '' }}">
      <i class="fas fa-file-invoice fa-fw"></i>
      Invoicer
   </a>
@endif
