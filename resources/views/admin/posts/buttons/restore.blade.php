@if(checkPerm('post_delete', $post))
   <a href="{{ route('admin.posts.restore', $post->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Restore Post">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </a>
@endif
