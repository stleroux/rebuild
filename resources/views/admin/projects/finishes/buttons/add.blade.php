@if(checkPerm('project_add'))
   <a href="{{ route('admin.projects.finishes.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Finish">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
   {{-- <button
      class="btn btn-{{ $size }} btn-success text-light"
      type="submit"
      formaction="{{ route('admin.projects.finishes.create') }}"
      formmethod="GET"
      title="Add Finish">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </button>    --}}
@endif
