@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	{{-- @include('admin.articles.edit.controls') --}}
@endsection


@section('content')
	{!! Form::model($article, ['route'=>['admin.articles.update', $article->id], 'method' => 'PUT']) !!}

	<div class="card mb-3">
		
		<div class="card-header section_header p-2">
			Edit Article
			<div class="float-right">
            <div class="btn-group">
					@include('admin.articles.buttons.back', ['size'=>'xs'])
   	         @include('admin.articles.buttons.update', ['size'=>'xs'])
				</div>
			</div>
		</div>

		<div class="card-body section_body p-2">
			@include('admin.articles.form')
		</div>
	</div>




	{!! Form::close() !!}
@endsection

@section ('scripts')
{{--   <script type="text/javascript" src="/js/jquery.datetimepicker.full.min.js"></script>
	<script>
		$("#datetime").datetimepicker({
			step: 30,
			showOn: 'button',
			buttonImage: '',
			buttonImageOnly: true,
			format:'Y-m-d H:i',
			lang:'ru'
		});
	</script> --}}
@endsection

	
