<button
   class="btn btn-{{ $size }} btn-primary text-light"
   type="submit"
   formaction="{{ route('posts.restoreAll') }}"
   formmethod="POST"
   id="bulk-restore"
   style="display:none; margin-left:2px"
   title="Restore Selected"
   onclick="return confirm('Are you sure you want to restore these posts?')">
   <i class="fa fa-download"></i>
</button>
