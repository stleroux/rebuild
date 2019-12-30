@if(checkPerm('post_edit'))
   <a href="{{ route('admin.posts.unpublish', $post->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Unpublish Post">
      <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
