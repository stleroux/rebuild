@extends('layouts.master')

@section ('stylesheets')
	{{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
	{{-- @include('recipes::index.controls') --}}
	@include('blocks.admin_menu')
@endsection

@section('right_column')
	{{-- @include('recipes::blocks.archives') --}}
@endsection

@section('content')
	
	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="card mb-3 pb-0 bg-transparent">
			<div class="card-header">
				<i class="fab fa-apple"></i>
				Trashed Recipes
				<span class="float-right">
					@include('common.buttons.help')
					@include('recipes::trashed.help')
					@include('common.buttons.deleteAll', ['model'=>'recipe'])
					@include('common.buttons.restoreAll', ['model'=>'recipe'])
					@include('common.buttons.publishAll', ['model'=>'recipe'])
				</span>
			</div>
	</form>
			
			@if($recipes->count() > 0)
				<div class="card-body card_body px-1 py-0">
					@include('recipes::table')
				</div>
			@else
				<div class="card-body card_body">
					{{ setting('no_records_found') }}
				</div>
			@endif

			<div class="card-footer px-1 py-0">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="2"><strong>Note:</strong></td>
					</tr>
					<tr>
						<td>Restore</td>
						<td>: Will restore the individual record. (Removes the deleted_at info but does not change anything else.)</td>
					</tr>
					<tr>
						<td>Delete</td>
						<td>: Will <span class="text-danger"><strong>permanently delete</strong></span> the individual record from the database.</td>
					</tr>
					<tr>
						<td>Publish Selected</td>
						<td>: Will set the deleted_at field to Null and the published_at field to the current date and time for all selected records.</td>
					</tr>
					<tr>
						<td>Restore Selected&nbsp;</td>
						<td>: Will set the deleted_at field to Null for all selected records. (Will not change anything else.)</td>
					</tr>
					<tr>
						<td>Delete Selected</td>
						<td>: Will <span class="text-danger"><strong>permanently delete</strong></span> all selected records from the database.</td>
					</tr>
				</table>
			</div>
		</div>


@stop

@section('scripts')
@stop