<button
   class="btn btn-sm btn-outline-success"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
   formmethod="POST"
   title="Save {{ ucfirst($model) }}">
   <i class="fa fa-save"></i>
   @if($type == 'menu')
      Update {{ $ucfirst($model) }}
   @endif
</button>