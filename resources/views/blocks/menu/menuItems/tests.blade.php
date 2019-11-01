@if(checkPerm('test_browse'))
   <a href="{{ route('tests.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('tests.*') ? 'menu_active' : '' }} text-warning">
      <i class="far fa-newspaper fa-fw"></i>
      Tests
   </a>
@endif
