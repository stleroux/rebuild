@if(checkPerm('tests_create'))
   <a href="{{ route('tests.create') }}"
      class="btn btn-sm btn-success"
      title="Add Test">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
