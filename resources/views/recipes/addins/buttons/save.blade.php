<button
   class="btn btn-sm btn-success"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
   formmethod="POST"
   title="Save Recipe">
   <i class="{{ Config::get('buttons.save') }}"></i>
</button>