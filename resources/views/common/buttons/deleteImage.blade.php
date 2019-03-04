<a href="{{ route('posts.deleteImage', $post->id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Delete Image">
   <i class="far fa-trash-alt"></i>
   @if($type == 'menu')
      Delete Image
   @endif
</a>