@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.future.controls')
	@include('admin.articles.future.help')
	@include('admin.articles.sidebar')
	@include('admin.articles.blocks.archives')
@endsection

@section('content')

@section('content')
	<form style="display:inline;">
		{!! csrf_field() !!}

		<div class="card">
			@include('admin.articles.future.panelHeader')
			@include('admin.articles.future.alphabet')
			@include('admin.articles.future.help')
			<div class="card-body">
				@if($articles->count())
					@include('admin.articles.future.datagrid')
				@else
					{{ setting('no_records_found') }}
				@endif
			</div>
		</div>
@endsection

@section('blocks')
	</form>
@endsection

@section('scripts')
	@include('admin.articles.common.btnScript')
@endsection