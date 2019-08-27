<button
   class="btn btn-{{ $size }} btn-primary text-light"
   type="reset"
   {{-- formaction="" --}}
   formmethod="POST"
   title="Reset Form">
   <i class="{{ Config::get('buttons.reset') }}"></i>
</button>