@if(checkPerm('projects_index'))
   <a href="{{ route('materials.index') }}"
      class="btn btn-{{ $size }} btn-primary"
      title="Materials">
      <i class="fas fa-hammer"></i>
   </a>
@endif
