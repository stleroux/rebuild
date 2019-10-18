@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection


@section('content')
	{!! Form::model($article, ['route'=>['admin.articles.update', $article->id], 'method' => 'PUT']) !!}
		{{-- <input type="hidden" value="{{ $ref }}" name="ref" size="50"/> --}}

{{-- 		<div class="panel text-right">
			<a href="{{ route($ref) }}" class="btn btn-default">Cancel</a>
			{{ Form::button('<i class="fa fa-save"></i> Update ', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
		</div> --}}

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
		@include('admin.articles.edit.form')
	</div>

	<div class="col-xs-12 col-sm-12 col-md-3">
		@include('admin.articles.edit.controls')
	</div>
</div>



	{!! Form::close() !!}
@stop

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
@stop

	
