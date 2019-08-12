{{-- @if(checkACL('user')) --}}
   <div class="col-md-3 px-1">
      <div class="card mb-2">
         <div class="card-header card_header p-2">Publish(ed) On</div>
         <div class="card-body p-1 text-center text-light">
            @if ($recipe->published_at)
               {{ $recipe->published_at->diffForHumans() }}
            @else
               N/A
            @endif
         </div>
      </div>
   </div>
{{-- @endif --}}