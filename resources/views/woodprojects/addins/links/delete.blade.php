@if(checkPerm('woodproject_delete'))
   <a href="{{ route('woodprojects.delete', $woodproject->id) }}"
      class="btn btn-{{ $size }} btn-danger"
      title="Delete Woodproject">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
