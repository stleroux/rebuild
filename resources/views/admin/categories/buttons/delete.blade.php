@if(checkPerm('category_delete'))
   <a href="{{ route('admin.categories.delete', $category->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Trash Category">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
