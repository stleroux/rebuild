@if(checkPerm('comment_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      type="button"
      onclick="location.href='{{ route('admin.comments.delete', $comment->id) }}'"
      title="Delete Comment">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif