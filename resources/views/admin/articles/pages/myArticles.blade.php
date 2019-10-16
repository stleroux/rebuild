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

			<div class="card-body section_body p-2">

				<div class="well well-sm text text-center" style="padding-top:4px; padding-bottom:4px; margin-top:0px; margin-bottom:0px;">
					<a href="{{ route('admin.articles.myArticles') }}" class="{{ Request::is('admin/articles/myArticles') ? "btn-primary": "btn-default" }} btn btn-sm">All</a>
					@foreach($letters as $value)
						<a href="{{ route('admin.articles.myArticles', $value) }}" class="{{ Request::is('admin/articles/myArticles/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm">{{ strtoupper($value) }}</a>
					@endforeach
				</div>

				
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
