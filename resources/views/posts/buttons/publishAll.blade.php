<button
   class="btn btn-{{ $size }} btn-primary text-light"
   type="submit"
   formaction="{{ route('posts.publishAll') }}"
   formmethod="POST"
   id="bulk-publish"
   style="display:none; margin-left:2px"
   title="Publish Selected"
   onclick="return confirm('Are you sure you want to unpublish these posts?')">
   <i class="fa fa-fw fa-download"></i>
</button>
