@if(checkPerm('post_restore', $post))
   <a href="{{ route('posts.restore', $post->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Restore Post">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </a>
@endif
