@if(checkPerm('projects_edit', $material))
   <a href="{{ route('materials.edit', $material->id) }}"
      class="btn btn-{{ $size }} btn-info"
      title="Edit Material">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif