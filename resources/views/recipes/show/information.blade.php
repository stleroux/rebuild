{{-- <table class="table table-sm">
   <tr>
      <td colspan="2">Created</td>
      <td colspan="2">Updated</td>
      <td colspan="2">Last Viewed</td>
   </tr>
   <tr>
      <td>On</td>
      <td>By</td>
      <td>On</td>
      <td>By</td>
      <td>On</td>
      <td>By</td>
   </tr>
   <tr>
      <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
      <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
      <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'modifiedBy'])</td>
      <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'updated_at'])</td>
      <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'lastViewedBy'])</td>
      <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on'])</td>
   </tr>
</table> --}}

<div class="col-md-2 pl-md-3 pr-md-1">
   <div class="card mb-2">
      <div class="card-header card_header p-2">Author</div>
      <div class="card-body p-1 text-center text-light">
         @include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])
      </div>
   </div>
</div>

<div class="col-md-2 px-md-1">
   <div class="card mb-2">
      <div class="card-header card_header p-2">Created On</div>
      <div class="card-body p-1 text-center text-light">
         @include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])
      </div>
   </div>
</div>

<div class="col-md-2 px-md-1">
   <div class="card mb-2">
      <div class="card-header card_header p-2">Updated By</div>
      <div class="card-body p-1 text-center text-light">
         @include('common.authorFormat', ['model'=>$recipe, 'field'=>'modifiedBy'])
      </div>
   </div>
</div>

<div class="col-md-2 px-md-1">
   <div class="card mb-2">
      <div class="card-header card_header p-2">Updated On</div>
      <div class="card-body p-1 text-center text-light">
         @include('common.dateFormat', ['model'=>$recipe, 'field'=>'updated_at'])
      </div>
   </div>
</div>

<div class="col-md-2 px-md-1">
   <div class="card mb-2">
      <div class="card-header card_header p-2">Last Viewed By</div>
      <div class="card-body p-1 text-center text-light">
         @include('common.authorFormat', ['model'=>$recipe, 'field'=>'lastViewedBy'])
      </div>
   </div>
</div>

<div class="col-md-2 pl-md-1 pr-md-3">
   <div class="card mb-2">
      <div class="card-header card_header p-2">Last Viewed On</div>
      <div class="card-body p-1 text-center text-light">
         @include('common.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on'])
      </div>
   </div>
</div>
