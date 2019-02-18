<button
   class="btn btn-sm btn-outline-danger"
   type="submit"
   formaction="{{ route($model.'s'.'.delete', $id) }}"
   formmethod="GET"
   title="Delete"
   {{-- onclick="return confirm('Are you sure you want to restore this {{ $model }}?')" --}}
   >
   <i class="fas fa-trash-alt"></i>
      {{-- Restore --}}
</button>