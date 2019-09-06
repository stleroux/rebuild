@if(checkPerm('permission_add'))
   <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
      formmethod="POST"
      title="Save & New">
      <i class="{{ Config::get('buttons.save&new') }}"></i>
   </button>
@endif
