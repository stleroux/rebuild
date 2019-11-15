@if(checkPerm('user_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success"
      type="submit"
      formmethod="POST"
      title="Save User">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
