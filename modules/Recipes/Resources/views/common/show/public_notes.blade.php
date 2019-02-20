{{-- @if(checkACL('user')) --}}
   <div class="col-md-12">
      <div class="card mb-2">
         <div class="card-header card_header_2">Author's Personal Notes <small>(Only showed to the creator of the item)</small></div>
         <div class="card-body">
            @if ($recipe->author_notes) 
               {!! $recipe->author_notes !!}
            @else
               N/A
            @endif
         </div>
      </div>
   </div>
{{-- @endif --}}