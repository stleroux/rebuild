{{-- @if(\Module::enabled('Recipes')) --}}
   @if($popularRecipes->count() > 0)
      <div class="card mb-2">
         <div class="card-header card_header_2">POPULAR RECIPES</div>
         <div class="card-body p-0 m-0">
            @foreach ($popularRecipes as $r)
               <a class="list-group-item p-1 m-0" href="{{ route('recipes.show', $r->id) }}" role="button">
                  <div class="text text-left">
                     <i class="far fa-address-card"></i>
                     {{ $r->title }}
                     <span class="badge badge-danger float-right">{{ $r->views }}</span>
                  </div>
               </a>
            @endforeach
         </div>
      </div>
   @endif
{{-- @endif --}}