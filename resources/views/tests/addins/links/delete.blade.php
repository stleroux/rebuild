@if(checkPerm('tests_delete'))
   <a href="{{ route('tests.delete', $test->id) }}"
      class="btn btn-{{ $size }} btn-danger"
      title="Delete Test">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
