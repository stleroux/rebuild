@if(checkPerm('user_edit'))
   <a href="{{ route('admin.users.addAllPermissions', $user->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add All Permissions">
      <i class="{{ Config::get('buttons.permissions') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
