@if(checkPerm('project_index'))
   <a href="{{ route('admin.projects.index') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('admin.projects.index') ? 'secondary' : 'primary' }} text-light"
      title="Projects">
      <i class="{{ Config::get('buttons.projects') }}"></i>
   </a>
@endif
