<a href="{{ route('users.removeAllPermissions', $user->id) }}"
   class="btn btn-{{ $size }} btn-danger text-light"
   title="Remove All Permissions">
   <i class="{{ Config::get('buttons.permissions') }}"></i>
</a>