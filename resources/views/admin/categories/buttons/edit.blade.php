@if(checkPerm('category_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="button"
      onclick="location.href='{{ route('admin.categories.edit', $category->id) }}'"
      title="EditCategory">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

{{-- <a href="{{ route('admin.categories.edit', $category->id) }}"
   class="btn btn-{{ $size }} btn-info text-light"
   title="Edit Category">
   <i class="{{ Config::get('buttons.edit') }}"></i>
</a> --}}
