<button
   class="btn btn-{{ $size }} btn-primary text-light"
   type="submit"
   formaction="{{ route('posts.unpublishAll') }}"
   formmethod="POST"
   id="bulk-publish"
   style="display:none;"
   title="Unpublish Selected"
   onclick="return confirm('Are you sure you want to unpublish these posts?')">
   <i class="{{ Config::get('buttons.unpublish') }} text-danger"></i>
</button>
