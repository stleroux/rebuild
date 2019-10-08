@if(checkPerm('setting_edit'))
   <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
      formmethod="POST"
      title="Update Setting">
      <i class="{{ Config::get('buttons.update') }}"></i>
   </button>
@endif
