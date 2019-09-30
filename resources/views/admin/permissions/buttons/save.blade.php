@if(checkPerm('permission_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      type="submit"
      formaction="{{ route('admin.permissions.store') }}"
      formmethod="POST"
      title="Save Permission">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
