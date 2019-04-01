<button
   class = "btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.unpublishAll') }}"
   formmethod="POST"
   id="bulk-unpublish"
   title="Unpublish Selected"
   style="display:none;"
   onclick="return confirm('Are you sure you want to unpublish these {{ $model }}s?')">
   <i class="fas fa-download"></i>
</button>
