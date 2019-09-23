@if(checkPerm('post_edit', $post))
   <a href="{{ route('admin.posts.edit', $post->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Post">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif
