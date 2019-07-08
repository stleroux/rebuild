@if(checkPerm('projects_delete'))
   <a href="{{ route('finishes.delete', $finish->id) }}"
      class="btn btn-{{ $size }} btn-danger"
      title="Delete Finish">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
