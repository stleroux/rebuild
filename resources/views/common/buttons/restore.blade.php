{{-- <button
   class="btn btn-sm btn-outline-secondary px-1 py-0"
   type="submit"
   formaction="{{ route($model.'s'.'.restore', $id) }}"
   formmethod="POST"
   id="bulk-restore"
   style="display:none;"
   onclick="return confirm('Are you sure you want to restore this {{ $model }}s?')">
      Restore
</button> --}}

<a href="{{ route($model.'s'.'.restore', $id) }}" class="btn btn-sm btn-outline-primary px-1 py-0">
   <i class="far fa-edit"></i>
   Restore
</a>