@if(checkPerm('category_add'))
   <a href="{{ route('categories.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Category">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
