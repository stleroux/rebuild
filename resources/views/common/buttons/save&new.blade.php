<button
   class="btn btn-sm btn-outline-primary"
   type="submit"
   {{-- formaction="{{ route($model.'s'.'.store') }}" --}}
   formmethod="POST"
   title="Save & New {{ ucfirst($model) }}">
      <i class="far fa-hdd"></i>
   @if($type == 'menu')
      Save & New {{ $ucfirst($model) }}
   @endif
</button>