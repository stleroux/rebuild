@if(checkPerm('projects_index'))
   <a href="{{ route('materials.index') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('materials.index') ? 'secondary' : 'primary' }} text-light"
      title="Materials">
      <i class="{{ Config::get('buttons.materials') }}"></i>
   </a>
@endif
