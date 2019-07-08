@if(checkPerm('projects_delete'))
   <a href="{{ route('materials.delete', $material->id) }}"
      class="btn btn-{{ $size }} btn-danger"
      title="Delete Material">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
