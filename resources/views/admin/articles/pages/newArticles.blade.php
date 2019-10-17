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

	<form style="display:inline;">
		{!! csrf_field() !!}
		
	<div class="row">
      <div class="col">
         <div class="card mb-3">
				<div class="card-header section_header p-2">
					<i class="fa fa-file-text-o"></i>
					New Articles
					@include('admin.posts.buttons.help', ['size'=>'xs', 'bookmark'=>'articles'])
					@include('admin.articles.buttons.add', ['size'=>'xs'])
				</div>
				<div class="card-body section_body p-2">
					@if($articles->count())

						<div class="well well-sm text text-center" style="padding-top:4px; padding-bottom:4px; margin-top:0px; margin-bottom:0px;">
							<a href="{{ route('admin.articles.newArticles') }}" class="{{ Request::is('admin/articles/newArticles') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
							@foreach($letters as $value)
								<a href="{{ route('admin.articles.newArticles', $value) }}" class="{{ Request::is('admin/articles/newArticles/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
							@endforeach
						</div>
			
						@include('admin.articles.newArticles.help')
						
						<div class="panel-body">
							@if($articles->count())
								@include('admin.articles.newArticles.datagrid')
							@else
								{{ setting('no_records_found') }}
							@endif
						</div>
					@else
						{{ setting('no_records_found') }}
					@endif
				</div>
			</div>
		</div>
	</div>
	
	</form>

@endsection
{{-- 
@section('blocks')
		@include('articles.newArticles.controls')
@endsection --}}

{{-- @section('scripts')
	@include('articles.newArticles.scripts')
@endsection --}}