<button
   class="btn btn-{{ $size }} btn-info text-light"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
   formmethod="POST"
   title="Update Post">
   <i class="{{ Config::get('buttons.save') }}"></i>
</button>