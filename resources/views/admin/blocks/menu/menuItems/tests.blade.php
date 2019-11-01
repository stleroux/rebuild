@if(checkPerm('test_index'))
   <a href="{{ route('admin.tests.index') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.tests.*') ? 'menu_active' : '' }} text-warning">
      <i class="far fa-newspaper fa-fw"></i>
      Tests
   </a>
@endif
