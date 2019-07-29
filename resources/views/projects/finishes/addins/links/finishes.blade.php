@if(checkPerm('projects_index'))
   <a href="{{ route('finishes.index') }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Finishes">
      <i class="fas fa-brush fa-fw"></i>
   </a>
@endif
