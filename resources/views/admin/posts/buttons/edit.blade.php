@if(checkPerm('post_edit', $post))
   <a href="{{ route('admin.posts.edit', $post->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Edit Post">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
