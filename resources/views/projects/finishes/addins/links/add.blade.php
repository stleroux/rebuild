@if(checkPerm('projects_create'))
   <a href="{{ route('finishes.create') }}"
      class="btn btn-sm btn-success"
      title="Add Finish">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif