<a href="{{ route('categories.edit', $category->id) }}"
   class="btn btn-{{ $size }} btn-info text-light"
   title="Edit Category">
   <i class="{{ Config::get('buttons.edit') }}"></i>
</a>
