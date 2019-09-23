@if(checkPerm('recipe_add'))
   <button
      class="btn btn-{{ $size }} btn-success"
      type="submit"
      {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
      formmethod="POST"
      title="Save Recipe">
      <i class="{{ Config::get('buttons.save') }}"></i>
   </button>
@endif
