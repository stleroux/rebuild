@if(checkPerm('projects_index'))
   <a href="{{ route('materials.index') }}"
      class="btn btn-sm btn-primary"
      title="Materials">
      <i class="fas fa-hammer"></i>
   </a>
@endif
