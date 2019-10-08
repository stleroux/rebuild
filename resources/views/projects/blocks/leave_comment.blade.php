@if(checkPerm('comment_add'))

   {!! Form::model($project, ['route'=>['projects.comment.store', $project->id]]) !!}

      <div class="card mb-2">
         <div class="card-header block_header p-2">
            <i class="fa fa-comment"></i>
            Leave a comment
         </div>
         <div class="card-body p-2 d-flex text text-center">
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }} pb-0 mb-0">
               {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'pb-0']) }}
               <span class="text-danger">{{ $errors->first('comment') }}</span>
            </div>
            {{ Form::button('<i class="fa fa-plus-circle"></i> Add Comment', ['type' => 'submit', 'class' => 'btn btn-sm btn-success'] )  }}
         </div>
         <div class="card-footer p-1">
            <small>Be a sport and keep your comments clean, otherwise they will be removed and you risk being banned from the site.</small>
         </div>
      </div>

   {!! Form::close() !!}

@endif
