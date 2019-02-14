<button
   class="btn btn-sm btn-outline-secondary px-1 py-0"
   type="submit"
   formaction="{{ route($model.'s'.'.publishAll') }}"
   formmethod="POST"
   id="bulk-publish"
   style="display:none;"
   onclick="return confirm('Are you sure you want to publish these {{ $model }}s?')">
      Publish Selected
</button>