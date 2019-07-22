{{-- {!! Form::open(['route' => 'projects.storeComment'], $project->id) !!} --}}
{{-- {!! Form::open(array('route' => 'projects.storeComment', 'id'=>$project->id, 'method'=>'POST')) !!} --}}
{!! Form::model($project, ['route'=>['projects.comment.store', $project->id], 'method'=>'POST']) !!}

<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fa fa-comment"></i>
      Leave a comment
   </div>
   <div class="card-body p-0 d-flex text text-center">
      {{-- <form> --}}
         <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }} pb-0 mb-0">
            {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'pb-0']) }}
            <span class="text-danger">{{ $errors->first('comment') }}</span>
         </div>
         {{ Form::button('<i class="fa fa-plus-circle"></i> Add Comment', ['type' => 'submit', 'class' => 'btn btn-sm btn-success'] )  }}
      {{-- {{ Form::close() }} --}}
   </div>
   <div class="card-footer p-1">
      <small>Be a sport and keep your comments clean, otherwise they will be removed and you risk being banned from the site.</small>
   </div>
</div>
{!! Form::close() !!}