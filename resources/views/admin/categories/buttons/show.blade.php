@if(checkPerm('category_read'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="button"
      onclick="location.href='{{ route('admin.categories.show', $category->id) }}'"
      title="Show Category">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

{{-- <a href="{{ route('admin.categories.show', $category->id) }}"
   class="btn btn-{{ $size }} btn-primary text-light"
   title="Show Category">
   <i class="{{ Config::get('buttons.show') }}"></i>
</a> --}}
