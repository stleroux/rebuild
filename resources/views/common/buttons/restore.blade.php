{{-- <button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.restore', $id) }}"
   formmethod="POST"
   title="Restore"
   onclick="return confirm('Are you sure you want to restore this {{ $model }}?')">
   <i class="fas fa-trash-restore-alt"></i>
      Restore
</button> --}}

<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.restore', $id) }}"
   formmethod="GET"
   title="Restore">
   {{-- <i class="fas fa-trash-restore"></i> --}}
   <i class="fas fa-trash-restore-alt"></i>
      {{-- Restore Selected --}}
</button>