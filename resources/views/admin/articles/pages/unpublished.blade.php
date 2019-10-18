@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.unpublished.controls')
	@include('admin.articles.sidebar')
	@include('admin.articles.blocks.archives')
@endsection

@section('content')
	<form style="display:inline;">
		{!! csrf_field() !!}

		<div class="card">

			<div class="card-header section_header p-2">
				Unpublished Articles
			</div>

			@include('admin.articles.unpublished.help')
			
			@if($articles->count())
				@include('admin.articles.unpublished.alphabet')
			@endif

			<div class="card-body section_body p-2">
				@if($articles->count())
					@include('admin.articles.unpublished.datagrid')
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
