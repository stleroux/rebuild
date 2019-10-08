@if(checkPerm('setting_add'))
   <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      name="new"
      value="new"
      {{-- formaction="{{ route('admin.permissions.store') }}" --}}
      {{-- formmethod="POST" --}}
      title="Save & New">
      <i class="{{ Config::get('buttons.save&new') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
