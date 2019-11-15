<a href="{{ route('blog.show', $post->slug) }}"
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
   title="View Blog">
   <i class="{{ Config::get('buttons.show') }}"></i>
   {{ $btn_label ?? '' }}
</a>
