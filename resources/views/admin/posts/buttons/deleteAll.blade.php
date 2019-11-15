@if(checkPerm('post_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      type="submit"
      formaction="{{ route('admin.posts.deleteAll') }}"
      formmethod="POST"
      id="bulk-delete"
      style="display:none;"
      title="Delete Selected"
      onclick="return confirm('Are you sure you want to trash these posts?')">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
