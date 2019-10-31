@if(checkPerm('test_edit', $article))
   <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      title="Update {$name}">
      <i class="{{ Config::get('buttons.update') }}"></i>
   </button>
@endif
