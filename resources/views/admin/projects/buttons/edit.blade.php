@if(checkPerm('projects_edit', $project))
   <a href="{{ route('admin.projects.edit', $project->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Woodproject">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif
