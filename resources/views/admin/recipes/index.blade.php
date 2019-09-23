@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.recipes.blocks.sidebar')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="card mb-2">
			<div class="card-header section_header p-2">
				<i class="{{ Config::get('buttons.published') }}"></i>
				Published Recipes
				<span class="float-right">
					<div class="btn-group">
						@include('admin.recipes.buttons.help', ['size'=>'sm', 'bookmark'=>'recipes'])
						@include('admin.recipes.buttons.unpublishAll', ['size'=>'sm'])
						@include('admin.recipes.buttons.trashAll', ['size'=>'sm'])
						@include('admin.recipes.buttons.add', ['size'=>'sm'])
					</div>
				</span>
			</div>

			@if($recipes->count() > 0)
				<div class="card-body section_body p-2">
					@include('recipes.alphabet', ['model'=>'recipe', 'page'=>'published'])
					<table id="datatable" class="table table-sm table-hover">
						<thead>
							<tr>
								<th><input type="checkbox" id="selectall" class="checked" /></th>
								<th>Name</th>
								<th>Category</th>
								<th>Views</th>
								<th>Favorited</th>
								<th>Author</th>
								<th>Created On</th>
								<th>Published On</th>
								<th data-orderable="false"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($recipes as $recipe)
							<tr>
								<td>
									<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$recipe->id}}" class="check-all">
								</td>
								<td>{{ ucwords($recipe->title) }}</td>
								<td>{{ ucwords($recipe->category->name) }}</td>
								<td>{{ $recipe->views }}</td>
								<td>{{ \App\Models\Recipes\Recipe::withTrashed()->find($recipe->id)->favoritesCount }}</td>
								<td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
								<td class="text-right">
									<div class="btn-group">
										@include('admin.recipes.buttons.view', ['size'=>'xs'])
										@include('admin.recipes.buttons.publish', ['size'=>'xs'])
										@include('admin.recipes.buttons.edit', ['size'=>'xs'])
										@include('admin.recipes.buttons.trash', ['size'=>'xs'])
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<div class="card-body card_body p-2">
					{{ setting('no_records_found') }}
				 </div>
			@endif
		</div>

	</form>

@endsection

@section('scripts')
	@include('scripts.bulkButtons')
@endsection