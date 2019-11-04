@if($popular->count() > 0)
   <div class="card mb-2">
      <div class="card-header block_header p-2">
         <i class="fab fa-apple"></i>
         Popular Recipes
      </div>
      <div class="card-body p-0 m-0">
         <ul class="list-group px-0 py-0">
            @foreach ($popular as $r)
               <a class="list-group-item list-group-item-action p-1" href="{{ route('recipes.show', $r->id) }}" role="button" style="text-decoration: none">
                  <div class="text text-left">
                     <i class="far fa-address-card fa-fw"></i>
                     {{ $r->title }}
                     <span class="badge badge-info text-dark float-right">{{ $r->views }}</span>
                  </div>
               </a>
            @endforeach
         </ul>
      </div>
   </div>
@endif
