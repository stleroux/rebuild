@extends('layouts.master')

@section('stylesheets')
	{{-- {{ Html::style('css/recipes.css') }} --}}
@stop

@section('left_column')
	{{-- @include('recipes::index.controls') --}}
	@include('blocks.admin_menu')
@endsection

@section('right_column')
	@include('recipes::blocks.archives')
@endsection

@section('content')
	
	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="card mb-3 pb-0 bg-transparent">
			<div class="card-header">
				<i class="fab fa-apple"></i>
				Recipes
				<span class="float-right">
					<button type="button" class="btn btn-sm btn-primary px-1 py-0" data-toggle="modal" data-target="#help">
						<i class="fa fa-question-circle" aria-hidden="true"></i>
						Help
					</button>
					<a href="{{ route('recipes.create') }}" class="btn btn-sm btn-outline-success px-1 py-0">
						<i class="fa fa-plus-square" aria-hidden="true"></i>
						Add Recipe
					</a>
				</span>
			</div>

			@if($recipes->count() > 0)
				<div class="text-center py-2">
					<a href="{{ route('recipes.published') }}" class="{{ Request::is('recipes/published') ? "btn-secondary": "btn-primary" }} btn btn-sm px-1 py-0">All</a>
					@foreach($letters as $value)
						<a href="{{ route('recipes.published', $value) }}" class="{{ Request::is('recipes/published/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm px-1 py-0">{{ strtoupper($value) }}</a>
					@endforeach
				</div>
			@endif

			@include('recipes::published.help')

			@if($recipes->count() > 0)
				<div class="card-body card_body px-1 py-0">
					@include('recipes::table')
				</div>
			@else
				<div class="card-body card_body">
               {{ setting('no_records_found') }}
              </div>
			@endif
		</div>

	</form>

@endsection
