<button
   class="btn btn-{{ $size }} btn-success text-light"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
   formmethod="POST"
   title="Save Comment">
   <i class="{{ Config::get('buttons.save') }}"></i>
</button>
