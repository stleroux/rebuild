@if(checkPerm('test_edit', $test))
   <a href="{{ route('admin.tests.edit', $test->id) }}"
      class="btn btn-{{ $size }} btn-info"
      title="Edit Test">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif