@if(checkPerm('project_read'))
   <a href="{{ route('admin.projects.show', $project->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Show Project">
      <i class="{{ Config::get('buttons.show') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
