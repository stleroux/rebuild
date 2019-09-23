@if(checkPerm('category_delete'))
   <a href="{{ route('admin.categories.delete', $category->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Category">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
