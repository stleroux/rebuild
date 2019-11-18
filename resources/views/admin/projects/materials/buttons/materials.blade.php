@if(checkPerm('project_browse'))
   <a href="{{ route('admin.projects.materials.index') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-{{ Route::is('admin.projects.materials.index') ? 'secondary' : 'primary' }} text-light"
      title="Materials">
      <i class="{{ Config::get('buttons.materials') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
