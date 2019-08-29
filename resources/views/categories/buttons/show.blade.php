@if(checkPerm('category_show'))
   <a href="{{ route('categories.show', $category->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Category">
      <i class="{{ Config::get('buttons.show') }}"></i>
   </a>
@endif
