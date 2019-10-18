@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.myArticles.controls')
	@include('admin.articles.sidebar')
	@include('admin.articles.blocks.archives')
@endsection

@section('content')
	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="card mb-3">

			<div class="card-header section_header p-2">
				My Articles
				@include('admin.articles.myArticles.help')
			</div>

			@include('admin.articles.myArticles.alphabet')

			<div class="card-body section_body p-2">
				
				@if($articles->count())
					@include('admin.articles.myArticles.datagrid')
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
