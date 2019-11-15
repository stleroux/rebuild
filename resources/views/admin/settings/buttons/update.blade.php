@if(checkPerm('setting_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      formmethod="POST"
      title="Update Setting">
      <i class="{{ Config::get('buttons.update') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
