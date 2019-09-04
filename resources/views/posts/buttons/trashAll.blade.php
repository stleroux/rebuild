{{-- @if(checkPerm('post_delete')) --}}
   <button
      class="btn btn-{{ $size }} btn-danger text-light"
      type="submit"
      formaction="{{ route('posts.trashAll') }}"
      formmethod="POST"
      id="bulk-trash"
      style="display:none;"
      title="Trash Selected"
      onclick="return confirm('Are you sure you want to trash these posts?')">
      <i class="{{ Config::get('buttons.trash') }}"></i>
   </button>
{{-- @endif --}}
