@if(checkPerm('permission_edit'))
   <a href="{{ route('permissions.edit', $permission->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Permission">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif
