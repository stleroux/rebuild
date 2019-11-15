@if(checkPerm('post_delete', $post))
   <a href="{{ route('admin.posts.restore', $post->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Restore Post">
      <i class="{{ Config::get('buttons.restore') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
