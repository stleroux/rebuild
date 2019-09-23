@if(checkPerm('permission_read'))
   <a href="{{ route('admin.permissions.show', $permission->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Permission">
      <i class="{{ Config::get('buttons.show') }}"></i>
   </a>
@endif
