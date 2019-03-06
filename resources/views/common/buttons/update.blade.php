<button
   class="btn btn-sm btn-outline-primary"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
   formmethod="POST"
   title="Update {{ ucfirst($model) }}">
   <i class="fa fa-save"></i>
   @if($type == 'menu')
      Update {{ ucfirst($model) }}
   @endif
</button>

