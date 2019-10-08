@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

	{!! Form::model($comment, ['route'=>['admin.comments.update', $comment->id], 'method'=>'PUT']) !!}

		<div class="row">
			<div class="col">
				<div class="card">
					<!--CARD HEADER-->
					<div class="card-header section_header p-2">
						<i class="fas fa-comments"></i>
						Comments
						<span class="float-right">
							<div class="btn-group">
								@include('admin.comments.buttons.back', ['size'=>'xs'])
								@include('admin.comments.buttons.reset', ['size'=>'xs'])
								@include('admin.comments.buttons.update', ['size'=>'xs'])
							</div>								
						</span>
					</div>

					<div class="card-body section_body p-2">

						<div class="row">
							<div class="col">
								<div class="form-group">
									{{ Form::label('name', 'Name') }}
									{{ Form::text ('name', $comment->user->username, ['class' => 'form-control form-control-sm', 'readonly']) }}
								</div>
							</div>

							<div class="col">
								<div class="form-group">
									{{ Form::label('email', 'Email') }}
									{{ Form::text ('email', $comment->user->email, ['class' => 'form-control form-control-sm', 'readonly']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<div class="form-group">
									{{ Form::label('comment', 'Comment') }}
									{{ Form::textarea('comment', $comment->comment, ['class'=>'form-control form-control-sm', 'autofocus', 'onfocus'=>'this.focus();this.select()']) }}
									<div class="pl-1 bg-danger">{{ $errors->first('comment') }}</div>
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