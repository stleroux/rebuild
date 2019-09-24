@if(checkPerm('category_read'))
   {{-- <a href="{{ route('admin.categories.show', $category->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Category">
      <i class="{{ Config::get('buttons.show') }}"></i>
   </a> --}}
   <button
      class="btn btn-{{ $size }} btn-primary text-light"
      type="submit"
      formaction="{{ route('admin.categories.show', $category->id) }}"
      formmethod="GET"
      title="Show Category">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
