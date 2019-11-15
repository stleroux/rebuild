@if(checkPerm('project_add'))
   <a href="{{ route('admin.projects.finishes.create') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add Finish">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
