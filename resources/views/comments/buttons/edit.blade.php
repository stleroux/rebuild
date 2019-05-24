@if(checkPerm('comments_edit', $comment))
   <a href="{{ route('comments.edit', $comment->id) }}"
      class="btn btn-sm btn-primary"
      title="Edit Comment">
      <i class="far fa-edit"></i>
   </a>
@else
   <button class="btn btn-sm btn-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button>
@endif