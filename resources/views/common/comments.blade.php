<div class="row py-1">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header card_header p-2">
            <i class="fa fa-comments-o"></i>
            Comments <small>({{ $model->comments()->count() }} total)</small>
         </div>
         <div class="card-body card_body text-light p-0">
            @if($model->comments->count())
               <table class="table table-sm table-hover mb-0 text-light">
                  <thead>
                     <tr>
                        <th class="col-sm-2">Name</th>
                        <th>Comment</th>
                        <th class="col-sm-2">Posted On</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($model->comments as $comment)
                        <tr>
                           <td>@include('common.authorFormat', ['model'=>$comment, 'field'=>'user'])</td>
                           <td>{!! $comment->comment !!}</td>
                           <td>@include('common.dateFormat', ['model'=>$comment, 'field'=>'created_at'])</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            @else
               <div class="text text-light p-2">No comments found</div>
            @endif
         </div>
      </div>
   </div>
</div>
