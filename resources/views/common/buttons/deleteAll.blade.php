<button
   class="btn btn-sm btn-outline-danger"
   type="submit"
   formaction="{{ route($model.'s'.'.deleteAll') }}"
   formmethod="POST"
   id="bulk-delete"
   title="Delete Selected"
   style="display:none"
   onclick="return confirm('Are you sure you want to permanently delete these {{ $model }}s?')">
   <i class="far fa-trash-alt"></i>
</button>