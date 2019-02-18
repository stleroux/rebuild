<button
   class="btn btn-sm btn-outline-danger"
   type="submit"
   formaction="{{ route($model.'s'.'.trashAll') }}"
   formmethod="POST"
   id="bulk-trash"
   title="Trash Selected"
   style="display:none;"
   onclick="return confirm('Are you sure you want to trash these {{ $model }}s?')">
   <i class="far fa-trash-alt"></i>
   {{-- Trash  Selected --}}
</button>