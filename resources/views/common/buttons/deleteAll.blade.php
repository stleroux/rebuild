<button
   class="btn btn-sm btn-outline-danger px-1 py-0"
   type="submit"
   formaction="{{ route($model.'s'.'.deleteAll') }}"
   formmethod="POST"
   id="bulk-delete"
   style="display:none"
   onclick="return confirm('Are you sure you want to permanently delete these {{ $model }}s?')">
      Delete Selected
</button>