@if(checkPerm('woodproject_edit', $woodproject))
   <a href="{{ route('woodprojects.edit', $woodproject->id) }}"
      class="btn btn-{{ $size }} btn-info"
      title="Edit Woodproject">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif