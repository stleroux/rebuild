@if(checkPerm('project_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      title="Update Finish">
      <i class="{{ Config::get('buttons.update') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
