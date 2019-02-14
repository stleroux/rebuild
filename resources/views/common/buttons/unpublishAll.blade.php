<button
   class = "btn btn-sm btn-outline-secondary px-1 py-0"
   type="submit"
   formaction="{{ route($model.'s'.'.unpublishAll') }}"
   formmethod="POST"
   id="bulk-unpublish"
   style="display:none;"
   onclick="return confirm('Are you sure you want to unpublish these {{ $model }}s?')">
      Unpublish Selected
</button>