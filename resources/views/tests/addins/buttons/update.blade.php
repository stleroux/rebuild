<button
   class="btn btn-sm btn-info"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
   formmethod="POST"
   title="Update Test">
   <i class="{{ Config::get('buttons.save') }}"></i>
</button>
