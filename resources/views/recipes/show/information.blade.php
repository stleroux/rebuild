<div class="col-md-2">
   <div class="card mb-2">
      <div class="card-header card_header_2">Author</div>
      <div class="card-body p-1 text-center">
         @include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])
      </div>
   </div>
</div>

<div class="col-md-2">
   <div class="card mb-2">
      <div class="card-header card_header_2">Created On</div>
      <div class="card-body p-1 text-center">
         @include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])
      </div>
   </div>
</div>

<div class="col-md-2">
   <div class="card mb-2">
      <div class="card-header card_header_2">Updated By</div>
      <div class="card-body p-1 text-center">
         @include('common.authorFormat', ['model'=>$recipe, 'field'=>'modifiedBy'])
      </div>
   </div>
</div>

<div class="col-md-2">
   <div class="card mb-2">
      <div class="card-header card_header_2">Updated On</div>
      <div class="card-body p-1 text-center">
         @include('common.dateFormat', ['model'=>$recipe, 'field'=>'updated_at'])
      </div>
   </div>
</div>

<div class="col-md-2">
   <div class="card mb-2">
      <div class="card-header card_header_2">Last Viewed By</div>
      <div class="card-body p-1 text-center">
         @include('common.authorFormat', ['model'=>$recipe, 'field'=>'lastViewedBy'])
      </div>
   </div>
</div>

<div class="col-md-2">
   <div class="card mb-2">
      <div class="card-header card_header_2">Last Viewed On</div>
      <div class="card-body p-1 text-center">
         @include('common.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on'])
      </div>
   </div>
</div>