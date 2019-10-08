@if(checkPerm('project_edit', $finish))
   <a href="{{ route('admin.projects.finishes.edit', $finish->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Edit Finish">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
  {{--  <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      formaction="{{ route('admin.projects.finishes.edit', $finish->id) }}"
      formmethod="GET"
      title="Edit Finish">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </button> --}}
@endif
