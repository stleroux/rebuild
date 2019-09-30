@if(checkPerm('category_add'))
   <a href="{{ route('admin.categories.create') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add Category">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
