@if(checkPerm('comment_add'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      type="submit"
      formaction="{{ route('admin.comments.store') }}"
      formmethod="POST"
      title="Save Comment">
      <i class="{{ Config::get('buttons.save') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
