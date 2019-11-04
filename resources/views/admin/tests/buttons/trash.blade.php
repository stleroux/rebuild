@if(checkPerm('test_delete', $test))
   <a href="{{ route('admin.tests.trash', $test->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Trash {$name}">
      <i class="{{ Config::get('buttons.trash') }}"></i>
   </a>
@endif
