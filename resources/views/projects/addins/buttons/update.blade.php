<button
   class="btn btn-{{ $size }} btn-info"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
   formmethod="POST"
   title="Update Woodproject">
   <i class="{{ Config::get('buttons.save') }}"></i>
</button>
