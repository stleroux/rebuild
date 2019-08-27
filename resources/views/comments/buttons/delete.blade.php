<a href="{{ route('comments.delete', $comment->id) }}"
   class="btn btn-{{ $size }} btn-danger text-light"
   title="Delete Comment">
   <i class="{{ Config::get('buttons.delete') }}"></i>
</a>