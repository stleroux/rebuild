@if(checkPerm('post_publish', $post))
   @if(!$post->published_at)
      <a href="{{ route('posts.publish', $post->id) }}"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Publish Post">
         {{-- <i class="fas fa-fw fa-lightbulb text-success"></i> --}}
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('posts.unpublish', $post->id) }}"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Unpublish Post">
         {{-- <i class="fas fa-fw fa-lightbulb text-danger"></i> --}}
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
      </a>
   @endif
@endif
