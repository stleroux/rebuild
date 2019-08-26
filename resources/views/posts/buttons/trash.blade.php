<a href="{{ route('posts.trash', $post->id) }}"
   class="btn btn-{{ $size }} btn-danger text-light"
   title="Trash Post">
   <i class="far fa-fw fa-trash-alt"></i>
</a>

{{-- @if(!$post->deleted_at)
   <a href="{{ route('posts.trash', $post->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Trash Post">
      <i class="far fa-trash-alt"></i>
   </a>
@else
   <a href="{{ route('posts.restore', $post->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Restore Post">
      <i class="far fa-trash-alt text-success"></i>
   </a>
@endif --}}