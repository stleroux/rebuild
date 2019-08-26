@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
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
					<div class="card-header section_header p-2">
						<i class="fas fa-comments"></i>
						Comments
						<span class="float-right">
							<div class="btn-group">
								@include('comments.buttons.back', ['size'=>'xs'])
								@include('comments.buttons.reset', ['size'=>'xs'])
								@include('comments.buttons.save', ['size'=>'xs'])
							</div>								
						</span>
					</div>

					<div class="card-body section_body p-2">

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
@endsection

@section ('scripts')
@endsection