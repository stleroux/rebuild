{{-- Page to display Articles in frontend --}}

@extends('layouts.master')

@section('title','Articles')

@section('stylesheets')
	{{ Html::style('css/articles.css') }}
@stop

@section('content')
	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="card">
			@include('articles.index.panelHeader')
			@include('articles.index.alphabet')
			@include('articles.index.help')
			<div class="panel-body">
				@if($articles->count())
					@include('articles.index.datagrid')
				@else
					@include('common.noRecordsFound')
				@endif
			</div>
		</div>
	</form>
@endsection

{{-- @section('scripts')
	@include('articles.common.btnScript')
@stop --}}