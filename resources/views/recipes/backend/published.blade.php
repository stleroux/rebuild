@extends('layouts.backend')

@section('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('left_column')
	{{-- @include('blocks.adminNav') --}}
	{{-- @include('recipes::backend.sidebar') --}}
	{{-- @include('blocks.admin_menu') --}}
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
				Published Recipes
				<span class="float-right">
					@include('common.buttons.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
					{{-- @include('recipes::backend.published.help') --}}
					@include('common.buttons.add', ['model'=>'recipe'])
					@include('common.buttons.unpublishAll', ['model'=>'recipe'])
					@include('common.buttons.trashAll', ['model'=>'recipe'])
				</span>
			</div>

			@if($recipes->count() > 0)
				<div class="card-body card_body p-2">
					@include('recipes.backend.alphabet', ['model'=>'recipe', 'page'=>'published'])
					{{-- @include('recipes::frontend.alphabet', ['model'=>'recipe']) --}}
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
								<td><a href="{{ route('recipes.show', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
								<td>{{ ucwords($recipe->category->name) }}</td>
								<td>{{ $recipe->views }}</td>
								<td>{{ \App\Models\Recipes\Recipe::withTrashed()->find($recipe->id)->favoritesCount }}</td>
								<td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
								<td class="text-right">
									@include('common.buttons.edit', ['name'=>'recipe', 'model'=>$recipe])
									
									@include('common.buttons.unpublish', ['model'=>'recipe', 'id'=>$recipe->id])
									@include('common.buttons.trash', ['model'=>'recipe', 'id'=>$recipe->id])
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
		</div>

	</form>

@endsection
