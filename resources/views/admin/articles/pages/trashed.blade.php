@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.trashed.controls')
	@include('admin.articles.sidebar')
	@include('admin.articles.blocks.archives')
@endsection

@section('content')
	<form style="display:inline;">
		{!! csrf_field() !!}

		<div class="card mb-3">

			<div class="card-header section_header p-2">
				Trashed Articles
			</div>

			<div class="card-body section_body p-2">
				{{-- @include('articles.trashed.panelHeader') --}}
				@include('admin.articles.trashed.alphabet')
				@include('admin.articles.trashed.help')
				<div class="panel-body">
					@if($articles->count())
						@include('admin.articles.trashed.datagrid')
					@else
						{{ setting('no_records_found') }}
					@endif
				</div>
			</div>
			<div class="card-footer">
				<p><strong>Note:</strong></p>
				<p><strong>Publish Selected</strong> will set the deleted_at field to Null and the published_at field to the current date and time for all selected records.</p>
				<p><strong>Restore Selected</strong> will set the deleted_at field to Null for all selected records. (Will not change anything else.)</p>
				<p><strong>Delete Selected</strong> will <span class="text-danger">permanently delete</span> all selected records from the database.</p>
			</div>
		</div>
	</form>
@endsection

@section('scripts')
	@include('admin.articles.common.btnScript')
@endsection
