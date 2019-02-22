@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('comments.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')
	{!! Form::model($comment, ['route'=>['comments.update', $comment->id], 'method' => 'PUT']) !!}

		{{-- Set a  variable if coming from the Post.Show view --}}
		{{-- @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.show')
			{{ Form::hidden('page', 'showPost') }}
		@endif --}}

		<div class="row">
			<div class="col">
				<div class="card">
					<!--CARD HEADER-->
					<div class="card-header card_header">
						<i class="fas fa-comments"></i>
						Comments
						<span class="float-right">
							<!-- Only show if coming from the comments page -->
							{{-- @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'comments.index')
							   <a href="{{ route('comments.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
									<i class="fas fa-angle-double-left"></i>
									Cancel
								</a>
							@endif --}}

							<!-- Only show if coming from the blog search page -->
							{{-- @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.show')
							   <a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
								  <i class="fa fa-arrow-left"></i> Previous
							   </a>
							@endif --}}

							@include('common.buttons.cancel', ['model'=>'comment', 'type'=>''])
							@include('common.buttons.reset', ['model'=>'comment', 'type'=>''])
							@include('common.buttons.save', ['model'=>'comment', 'type'=>''])

							{{-- {{ Form::button('<i class="fas fa-sync-alt"></i> Reset Form', ['type'=>'reset', 'class'=>'btn btn-sm btn-outline-secondary px-1 py-0']) }} --}}
							{{-- {{ Form::button('<i class="fa fa-save"></i> Update ', ['type' => 'submit', 'class' => 'btn btn-sm btn-outline-bprimary px-1 py-0'])  }} --}}
						</span>
					</div>

					<div class="card-body card_body">

						<div class="row">
							<div class="col">
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									{{ Form::label('name', 'Name:') }}
									{{ Form::text('name', $comment->user->username, ['class' => 'form-control form-control-sm', 'readonly']) }}
									<span class="text-danger">{{ $errors->first('name') }}</span>
								</div>
							</div>

							<div class="col">
								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
									{{ Form::label('email', 'Email:') }}
									{{ Form::text('email', $comment->user->email, ['class' => 'form-control form-control-sm', 'readonly']) }}
									<span class="text-danger">{{ $errors->first('email') }}</span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
									{{ Form::label('comment', 'Comment:') }}
									{{ Form::textarea('comment', null, ['class' => 'form-control form-control-sm', 'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
									<span class="text-danger">{{ $errors->first('comment') }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	{{ Form::close() }}
@stop

@section ('scripts')
@stop