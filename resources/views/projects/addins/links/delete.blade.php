@if(checkPerm('projects_delete'))
   <a href="{{ route('projects.delete', $project->id) }}"
      class="btn btn-{{ $size }} btn-danger"
      title="Delete Project">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
