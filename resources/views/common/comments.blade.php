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
                  <th scope="col">Name</th>
                  <th scope="col">Comment</th>
                  <th scope="col">Posted On</th>
               </tr>
            </thead>
            <tbody>
               @foreach($model->comments as $comment)
                  <tr scope="row">
                     <td>@include('common.authorFormat', ['model'=>$comment, 'field'=>'user'])</td>
                     <td>{!! $comment->comment !!}</td>
                     <td>@include('common.dateFormat', ['model'=>$comment, 'field'=>'created_at'])</td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      @else
         <div class="text text-light p-1">No comments found</div>
      @endif
   </div>
</div>
