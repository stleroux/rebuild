<button
   class="btn btn-{{ $size }} btn-danger text-light"
   type="submit"
   formaction="{{ route('posts.trashAll') }}"
   formmethod="POST"
   id="bulk-trash"
   style="display:none; margin-left:2px"
   title="Trashed Selected"
   onclick="return confirm('Are you sure you want to trash these posts?')">
   <i class="far fa-trash-alt"></i>
</button>
