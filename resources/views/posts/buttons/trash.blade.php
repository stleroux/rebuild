@if(checkPerm('post_delete', $post))
   <a href="{{ route('posts.trash', $post->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Trash Post">
      <i class="{{ Config::get('buttons.trash') }}"></i>
   </a>
@endif
