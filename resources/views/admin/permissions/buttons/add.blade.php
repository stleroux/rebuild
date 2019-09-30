@if(checkPerm('permission_add'))
{{--    <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      type="button"
      onclick="location.href='{{ route('admin.permissions.create') }}'"
      title="Add Permission">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </button> --}}
   <a href="{{ route('admin.permissions.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Permission">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
