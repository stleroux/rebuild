@if(checkPerm('post_delete'))
   <a href="{{ route('posts.delete', $post->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Post">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
