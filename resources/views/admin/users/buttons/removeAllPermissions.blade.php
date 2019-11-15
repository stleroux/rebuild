@if(checkPerm('user_edit'))
   <a href="{{ route('admin.users.removeAllPermissions', $user->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Remove All Permissions">
      <i class="{{ Config::get('buttons.permissions') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
