<a href="{{ route('admin.users.addAllPermissions', $user->id) }}"
   class="btn btn-{{ $size }} btn-success text-light"
   title="Add All Permissions">
   <i class="{{ Config::get('buttons.permissions') }}"></i>
</a>