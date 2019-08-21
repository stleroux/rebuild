@if(!$post->published_at)
   <a href="{{ route('posts.publish', $post->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Publish Post">
      {{-- <i class="fas fa-upload"></i> --}}
      {{-- <i class="fas fa-circle text-success"></i> --}}
      <i class="fas fa-lightbulb text-success"></i>
   </a>
@else
   <a href="{{ route('posts.unpublish', $post->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Unpublish Post">
      {{-- <i class="fas fa-download"></i> --}}
      {{-- <i class="fas fa-circle text-danger"></i> --}}
      <i class="fas fa-lightbulb text-danger"></i>
   </a>
@endif
