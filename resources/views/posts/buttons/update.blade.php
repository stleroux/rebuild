@if(checkPerm('post_edit', $post))
   <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      {{-- formaction="{{ route($model.'s'.'.update') }}" --}}
      formmethod="POST"
      title="Update Post">
      <i class="{{ Config::get('buttons.update') }}"></i>
   </button>
@endif
