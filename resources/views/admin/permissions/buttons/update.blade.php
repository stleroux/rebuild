@if(checkPerm('permission_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      formaction="{{ route('admin.permissions.update', $permission->id) }}"
      formmethod="POST"
      title="Update Permission">
      <i class="{{ Config::get('buttons.update') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
