@if(checkPerm('projects_delete'))
   <a href="{{ route('admin.projects.delete', $project->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Project">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif