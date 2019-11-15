@if(checkPerm('setting_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      name="new"
      value="new"
      title="Save & New">
      <i class="{{ Config::get('buttons.save&new') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
