@if(checkPerm('category_add'))
{{--    <a href="{{ route('admin.categories.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Category">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a> --}}
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      type="submit"
      formaction="{{ route('admin.categories.create') }}"
      formmethod="GET"
      title="Add Category">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
