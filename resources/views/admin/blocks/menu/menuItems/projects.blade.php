@if(checkPerm('project_browse'))
   <a href="{{ route('admin.projects.index') }}"
      class="list-group-item list-group-item-action p-1 {{
      (
         Route::is('admin.projects.index') ||
         Route::is('admin.projects.show') ||
         Route::is('admin.projects.edit') ||
         Route::is('admin.projects.create') ||
         Route::is('admin.projects.finishes*') ||
         Route::is('admin.projects.materials*')
      ) ? 'menu_active' : '' }}">
      <i class="fab fa-pagelines fa-fw"></i>
      Projects
   </a>
@endif
