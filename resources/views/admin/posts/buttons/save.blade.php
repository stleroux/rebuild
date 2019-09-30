@if(checkPerm('post_add'))
   <button
      class="btn btn-{{ $size }} btn-success text-light"
      type="submit"
      {{-- formaction="{{ route('admin.posts.store') }}" --}}
      {{-- formmethod="POST" --}}
      title="Save Post">
      <i class="{{ Config::get('buttons.save') }}"></i>
   </button>
@endif
