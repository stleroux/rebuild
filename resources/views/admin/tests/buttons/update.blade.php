@if(checkPerm('test_edit', $test))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="submit"
      title="Update {$name}">
      <i class="{{ Config::get('buttons.update') }}"></i>
   </button>
@endif
