@if(checkPerm('post_read', $post))
   <a href="{{ route('admin.posts.show', $post->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Post">
      <i class="{{ Config::get('buttons.show') }}"></i>
   </a>
@endif
