<button
   class="btn btn-sm btn-outline-danger px-1 py-0"
   type="submit"
   formaction="{{ route($model.'s'.'.trashAll') }}"
   formmethod="POST"
   id="bulk-trash"
   style="display:none;"
   onclick="return confirm('Are you sure you want to trash these {{ $model }}s?')">
      Trash  Selected
</button>