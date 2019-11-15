@if(checkPerm('project_delete'))
   <a href="{{ route('admin.projects.materials.delete', $material->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Delete Material">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
