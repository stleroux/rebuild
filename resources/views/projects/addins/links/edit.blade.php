@if(checkPerm('projects_edit', $project))
   <a href="{{ route('projects.edit', $project->id) }}"
      class="btn btn-{{ $size }} btn-info"
      title="Edit Woodproject">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif