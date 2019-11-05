@if(checkPerm('test_delete', $test))
   <a href="{{ route('admin.tests.restore', $test->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Restore Test">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </a>
@endif
