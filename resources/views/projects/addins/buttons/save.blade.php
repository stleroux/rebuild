<button
   class="btn btn-sm btn-success"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
   formmethod="POST"
   title="Save Woodproject">
   <i class="{{ Config::get('buttons.save') }}"></i>
</button>