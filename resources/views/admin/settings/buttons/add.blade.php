@if(checkPerm('setting_add'))
   <a href="{{ route('admin.settings.create') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add Setting">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
