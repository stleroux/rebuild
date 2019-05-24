{{-- @if(checkPerm('categories_edit', $category)) --}}
   <a href="{{ route('categories.edit', $category->id) }}"
      class="btn btn-sm btn-primary"
      title="Edit Category">
      <i class="far fa-edit"></i>
   </a>
{{-- @else
   <button class="btn btn-sm btn-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button>
@endif --}}