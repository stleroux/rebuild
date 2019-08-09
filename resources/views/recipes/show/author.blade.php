{{-- @if(checkACL('user')) --}}
   <div class="col-md-3">
      <div class="card mb-2">
         <div class="card-header card_header p-2">Author</div>
         <div class="card-body card_body p-1 text-center">
            @include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])
         </div>
      </div>
   </div>
{{-- @endif --}}