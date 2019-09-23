@if(checkPerm('projects_delete'))
   <a href="{{ route('admin.projects.finishes.delete', $finish->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Finish">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
