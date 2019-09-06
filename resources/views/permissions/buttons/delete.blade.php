@if(checkPerm('permission_delete'))
   <a href="{{ route('permissions.delete', $permission->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Permission">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
