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

		<div class="card mb-3">

			<div class="card-header section_header p-2">
				Future Articles
			</div>
			
			@include('admin.articles.future.alphabet')
			
			<div class="card-body section_body p-2">
				@include('admin.articles.future.help')
			
				@if($articles->count())
					@include('admin.articles.future.datagrid')
				@else
					{{ setting('no_records_found') }}
				@endif
			</div>
		</div>
	</form>
@endsection

@section('scripts')
	@include('admin.articles.common.btnScript')
@endsection
