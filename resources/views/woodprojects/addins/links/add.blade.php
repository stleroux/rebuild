@if(checkPerm('woodprojects_create'))
   <a href="{{ route('woodprojects.create') }}"
      class="btn btn-sm btn-success"
      title="Add Woodproject">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
