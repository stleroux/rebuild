@if(checkPerm('permission_delete'))
   <a href="{{ route('admin.permissions.delete', $permission->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Delete Permission">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
