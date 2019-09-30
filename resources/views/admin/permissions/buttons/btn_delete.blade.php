@if(checkPerm('permission_delete'))
   {{-- <button
      class="btn {{ $size ? 'btn-.$size' : '' }} btn-danger text-light"
      type="submit"
      formaction="{{ route('admin.permissions.destroy', $permission->id) }}"
      formmethod="POST"
      title="Delete Permission">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button> --}}
   <a href="{{ route('admin.permissions.delete', $permission->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Permission">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
