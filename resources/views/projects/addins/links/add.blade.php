@if(checkPerm('projects_create'))
   <a href="{{ route('projects.create') }}"
      class="btn btn-sm btn-success"
      title="Add Project">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif