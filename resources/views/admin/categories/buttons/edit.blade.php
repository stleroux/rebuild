@if(checkPerm('category_edit'))
   <a href="{{ route('admin.categories.edit', $category->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Edit Category">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif

