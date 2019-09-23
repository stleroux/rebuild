@if(checkPerm('post_edit'))
   @if(!$post->published_at)
      <a href="{{ route('admin.posts.publish', $post->id) }}"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Publish Post">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('admin.posts.unpublish', $post->id) }}"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Unpublish Post">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
      </a>
   @endif
@endif
