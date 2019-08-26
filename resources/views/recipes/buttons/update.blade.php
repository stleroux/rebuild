@if(checkPerm('recipe_edit'))
   <button
      class="btn btn-{{ $size }} btn-info"
      type="submit"
      {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
      formmethod="POST"
      title="Update Recipe">
      <i class="{{ Config::get('buttons.save') }}"></i>
   </button>
@endif
