@if(checkPerm('category_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      type="button"
      onclick="location.href='{{ route('admin.categories.create') }}'"
      title="Add Category">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

{{--    <a href="{{ route('admin.categories.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Category">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a> --}}
