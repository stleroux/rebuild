@if(checkPerm('category_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      formaction="{{ route('admin.categories.update', $category->id) }}"
      formmethod="POST"
      title="Update Category">
      <i class="{{ Config::get('buttons.update') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
