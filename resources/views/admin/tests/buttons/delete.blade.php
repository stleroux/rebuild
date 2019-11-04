@if(checkPerm('test_delete'))
   <a href="{{ route('admin.tests.delete', $test->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger"
      title="Delete Test">
      <i class="{{ Config::get('buttons.delete') }}"></i>
   </a>
@endif
