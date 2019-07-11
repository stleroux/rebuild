{{-- @if(\Module::enabled('Posts')) --}}
   @if($popularProjects->count() > 0)
      <div class="card mb-2">
         <div class="card-header block_header">
            <i class="fas fa-blog"></i>
            Popular Projects
         </div>
         <div class="card-body p-0 m-0">
            @foreach ($popularProjects as $p)
               <a class="list-group-item p-1 m-0" href="{{ route('projects.show', $p->id) }}" role="button" style="text-decoration: none">
                  <div class="text text-left">
                     <i class="far fa-address-card"></i>
                     {{ $p->name }}
                     <span class="badge badge-danger float-right">{{ $p->views }}</span>
                  </div>
               </a>
            @endforeach
         </div>
      </div>
   @endif
{{-- @endif --}}