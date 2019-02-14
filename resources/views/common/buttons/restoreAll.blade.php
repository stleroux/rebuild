<button
   class="btn btn-sm btn-outline-secondary px-1 py-0"
   type="submit"
   formaction="{{ route($model.'s'.'.restoreAll') }}"
   formmethod="POST"
   id="bulk-restore"
   style="display:none;"
   onclick="return confirm('Are you sure you want to restore all these {{ $model }}s?')">
      Restore Selected
</button>