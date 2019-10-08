@if(checkPerm('user_edit'))
   <a href="{{ route('admin.users.removeAllPermissions', $user->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Remove All Permissions">
      <i class="{{ Config::get('buttons.permissions') }}"></i>
   </a>
@endif
