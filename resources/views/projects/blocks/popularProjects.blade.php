@if($popularProjects->count() > 0)
   <div class="card mb-2">
      <div class="card-header block_header p-2">
         <i class="fab fa-pagelines"></i>
         Popular Projects
      </div>
      <div class="card-body p-0 m-0">
         <ul class="list-group px-0 py-0">
            @foreach ($popularProjects as $p)
               <a class="list-group-item list-group-item-action p-1" href="{{ route('admin.projects.show', $p->id) }}" role="button" style="text-decoration: none">
                  <div class="text text-left">
                     <i class="far fa-address-card"></i>
                     {{ ucwords($p->name) }}
                     <span class="badge badge-danger float-right">{{ $p->views }}</span>
                  </div>
               </a>
            @endforeach
         </ul>
      </div>
   </div>
@endif
