@if(checkPerm('projects_index'))
   <a href="{{ route('admin.projects.finishes.index') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('admin.projects.finishes.index') ? 'secondary' : 'primary' }} text-light"
      title="Finishes">
      <i class="{{ Config::get('buttons.finishes') }}"></i>
   </a>
@endif
