{{-- @if(checkACL('user')) --}}
   <div class="col-md-3">
      <div class="card mb-2">
         <div class="card-header card_header_2">Author</div>
         <div class="card-body text-center">
            @include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])
         </div>
      </div>
   </div>
{{-- @endif --}}