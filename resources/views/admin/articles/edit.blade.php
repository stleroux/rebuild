@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.edit.controls')
@endsection


@section('content')
	{!! Form::model($article, ['route'=>['admin.articles.update', $article->id], 'method' => 'PUT']) !!}
		{{-- <input type="hidden" value="{{ $ref }}" name="ref" size="50"/> --}}


	<div class="card mb-3">
		
		<div class="card-header section_header p-2">
			Article Details
			<div class="float-right">
				<a href="{{ route('admin.articles.index') }}" class="btn btn-xs btn-primary">Cancel</a>
				{{ Form::button('<i class="fa fa-cancel"></i> Cancel ', array('type' => 'submit', 'class' => 'btn btn-xs btn-info')) }}
				{{ Form::button('<i class="fa fa-save"></i> Update ', array('type' => 'submit', 'class' => 'btn btn-xs btn-info')) }}
			</div>
		</div>

		<div class="card-body section_body p-2">
			{{-- <div class="row"> --}}
				@include('admin.articles.edit.form')
			{{-- </div> --}}
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

	
