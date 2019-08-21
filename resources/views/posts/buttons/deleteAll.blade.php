<button
   class="btn btn- {{ $size }} btn-danger text-light"
   type="submit"
   formaction="{{ route('posts.deleteAll') }}"
   formmethod="POST"
   id="bulk-delete"
   style="display:none; margin-left:2px"
   title="Delete Selected"
   onclick="return confirm('Are you sure you want to trash these posts?')">
   <i class="far fa-trash-alt"></i>
</button>
