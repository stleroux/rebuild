@if(checkPerm('category_read'))
   <a href="{{ route('admin.categories.show', $category->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Show Category">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif

