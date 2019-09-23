@if(checkPerm('comment_delete'))
   <a href="{{ route('admin.comments.delete', $comment->id) }}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Comment">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif