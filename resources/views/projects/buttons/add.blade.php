@if(checkPerm('projects_create'))
   <a href="{{ route('projects.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Project">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
