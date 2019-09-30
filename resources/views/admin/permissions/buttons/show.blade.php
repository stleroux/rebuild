@if(checkPerm('permission_read'))
{{--    <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="button"
      onclick="location.href='{{ route('admin.permissions.show', $permission->id) }}'"
      title="Show Permission">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </button> --}}
   <a href="{{ route('admin.permissions.show', $permission->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Permission">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
