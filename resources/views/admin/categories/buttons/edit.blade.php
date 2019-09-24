@if(checkPerm('category_edit'))
   {{-- <a href="{{ route('admin.categories.edit', $category->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Category">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a> --}}
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      formaction="{{ route('admin.categories.edit', $category->id) }}"
      formmethod="GET"
      title="EditCategory">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
