@if(checkPerm('category_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      type="submit"
      formaction="{{ route('admin.categories.delete', $category->id) }}"
      formmethod="GET"
      title="Delete Category">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

{{-- <a href="{{ route('admin.categories.delete', $category->id) }}"
   class="btn btn-{{ $size }} btn-danger text-light"
   title="Delete Category">
   <i class="{{ Config::get('buttons.delete') }}"></i>
   {{ $btn_label ?? '' }}
</a> --}}
