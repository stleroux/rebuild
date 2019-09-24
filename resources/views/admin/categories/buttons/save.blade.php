@if(checkPerm('category_add'))
   <button
      class="btn btn-{{ $size }} btn-success text-light"
      type="submit"
      formaction="{{ route('admin.categories.store') }}"
      formmethod="POST"
      title="Save Category">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
