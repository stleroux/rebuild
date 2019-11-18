@if(checkPerm('project_browse'))
   <a href="{{ route('admin.projects.finishes.index') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-{{ Route::is('admin.projects.finishes.index') ? 'secondary' : 'primary' }} text-light"
      title="Finishes">
      <i class="{{ Config::get('buttons.finishes') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
