@if(checkPerm('post_edit'))
   @if(!$post->published_at)
      <a href="{{ route('admin.posts.publish', $post->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Publish Post">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('admin.posts.unpublish', $post->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Unpublish Post">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endif
