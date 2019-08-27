@if(checkPerm('projects_index'))
   <a href="{{ route('projects.list') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('projects.list') ? 'secondary' : 'primary' }} text-light"
      title="Projects">
      <i class="{{ Config::get('buttons.projects') }}"></i>
   </a>
@endif
