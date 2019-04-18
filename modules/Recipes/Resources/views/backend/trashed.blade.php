@extends('layouts.backend')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
	{{-- @include('blocks.adminNav') --}}
	{{-- @include('recipes::backend.sidebar') --}}
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
					@include('common.buttons.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
					{{-- @include('recipes::backend.trashed.help') --}}
					@include('common.buttons.deleteAll', ['model'=>'recipe', 'type'=>''])
					@include('common.buttons.restoreAll', ['model'=>'recipe', 'type'=>''])
					@include('common.buttons.publishAll', ['model'=>'recipe', 'type'=>''])
				</span>
			</div>
	</form>
			
			@if($recipes->count() > 0)
				<div class="card-body card_body p-2">
					@include('common.alphabet', ['model'=>'recipe', 'page'=>'trashed'])
					<table id="datatable" class="table table-sm table-hover">
					   <thead>
					      <tr>
					         <th><input type="checkbox" id="selectall" class="checked" /></th>
					         <th>Name</th>
					         <th>Category</th>
					         <th>Views</th>
					         <th>Author</th>
					         <th>Created On</th>
					         <th>Trashed On</th>
					         <th>Publish(ed) On</th>
					         <th data-orderable="false"></th>
					      </tr>
					   </thead>
					   <tbody>
					      @foreach($recipes as $recipe)
					      <tr>
					         <td>
					            <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$recipe->id}}" class="check-all">
					         </td>
					         <td><a href="{{ route('recipes.show', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
					         <td>{{ ucwords($recipe->category->name) }}</td>
					         <td>{{ $recipe->views }}</td>
					         <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'deleted_at'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
					         <td class="text-right">
					            {{-- @include('common.buttons.edit', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>'']) --}}
					            @include('common.buttons.restore', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
					            @include('common.buttons.delete', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
					         </td>
					      </tr>
					      @endforeach
					   </tbody>
					</table>
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