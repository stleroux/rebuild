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

         <div class="card mb-3">

				<div class="card-header section_header p-2">
					<i class="fa fa-file-text-o"></i>
					Articles
					@include('admin.posts.buttons.help', ['size'=>'xs', 'bookmark'=>'articles'])
					@include('admin.articles.buttons.add', ['size'=>'xs'])
				</div>

				@if($articles->count())
					@include('admin.articles.index.alphabet')
				@endif
				
				<div class="card-body section_body p-2">
					@if($articles->count())
						@include('admin.articles.index.datagrid')
					@else
						{{ setting('no_records_found') }}
					@endif
				</div>
			</div>

@endsection

@section('scripts')
	@include('admin.articles.common.btnScript')
@stop