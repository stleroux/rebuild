@if(checkPerm('projects_index'))
   <a href="{{ route('projects.list') }}"
      class="btn btn-sm btn-primary"
      title="Projects">
      {{-- <i class="fab fa-pagelines fa-fw"></i> --}}
      <i class="fas fa-list-ol fa-fw"></i>
   </a>
@endif
