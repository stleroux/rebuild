@if(checkPerm('projects_index'))
   <a href="{{ route('finishes.index') }}"
      class="btn btn-{{ $size }} btn-{{ Route::is('finishes.index') ? 'secondary' : 'primary' }} text-light"
      title="Finishes">
      <i class="{{ Config::get('buttons.finishes') }}"></i>
   </a>
@endif
