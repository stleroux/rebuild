@if(checkPerm('category_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      type="submit"
      title="Save Category">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
