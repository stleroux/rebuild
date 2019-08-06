{{-- @if(checkACL('user')) --}}
   <div class="col-md-12">
      <div class="card mb-2">
         <div class="card-header card_header p-2">Author's Notes</div>
         <div class="card-body p-1 text-light">
            @if ($recipe->public_notes) 
               {!! $recipe->public_notes !!}
            @else
               N/A
            @endif
         </div>
      </div>
   </div>
{{-- @endif --}}