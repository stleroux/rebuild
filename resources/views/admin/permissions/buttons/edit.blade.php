@if(checkPerm('permission_edit'))
{{--    <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="button"
      onclick="location.href='{{ route('admin.permissions.edit', $permission->id) }}'"
      title="Edit Permission">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </button> --}}
   <a href="{{ route('admin.permissions.edit', $permission->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Permission">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
