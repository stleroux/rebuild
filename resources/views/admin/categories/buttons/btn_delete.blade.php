@if(checkPerm('category_delete'))
   <button
      class="btn {{ $size ? 'btn-.$size' : '' }} btn-danger text-light"
      type="submit"
      title="Delete Category">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
