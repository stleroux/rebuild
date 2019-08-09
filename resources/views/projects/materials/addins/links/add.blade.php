@if(checkPerm('projects_create'))
   <a href="{{ route('materials.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Material">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
