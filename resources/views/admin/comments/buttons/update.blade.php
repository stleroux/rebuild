@if(checkPerm('comment_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      formaction="{{ route('admin.comments.update', $comment->id) }}"
      formmethod="POST"
      title="Update Comment">
      <i class="{{ Config::get('buttons.update') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif