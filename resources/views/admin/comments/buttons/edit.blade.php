@if(checkPerm('comment_edit', $comment))
   <a href="{{ route('admin.comments.edit', $comment->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Comment">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@else
   <button class="btn btn-{{ $size }} btn-info" disabled="disabled">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </button>
@endif