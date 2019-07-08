@if(checkPerm('projects_edit', $finish))
   <a href="{{ route('finishes.edit', $finish->id) }}"
      class="btn btn-{{ $size }} btn-info"
      title="Edit Finish">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif