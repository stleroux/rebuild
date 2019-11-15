{{-- We do not add the $comment model here as we do not want individual users to be able to delete their comments once posted --}}
@if(checkPerm('comment_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      type="submit"
      formaction="{{ route('admin.comments.destroy', $comment->id) }}"
      formmethod="POST"
      title="Delete Comment">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
