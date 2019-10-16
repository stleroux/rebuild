@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.sidebar')
	@include('admin.articles.blocks.archives')
@endsection

@section('content')

@section('content')
	<form style="display:inline;">
		{!! csrf_field() !!}

		<div class="card">
			@include('articles.future.panelHeader')
			@include('articles.future.alphabet')
			@include('articles.future.help')
			<div class="card-body">
				@if($articles->count())
					@include('articles.future.datagrid')
				@else
					@include('common.noRecordsFound')
				@endif
			</div>
		</div>
@endsection

@section('blocks')
		@include('articles.future.controls')
		@include('articles.future.help')
	</form>
@endsection

@section('scripts')
	@include('articles.common.btnScript')
@endsection