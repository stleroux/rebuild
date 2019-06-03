@extends('layouts.recipes')

@section('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="card mb-3 pb-0">
			<div class="card-header card_header">
				<span class="h5 align-middle pt-2">
					<i class="{{ Config::get('buttons.published') }}"></i>
					Published Recipes
				</span>
				<span class="float-right">
					@include('recipes.addins.links.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
					@include('recipes.addins.links.add')
						@include('recipes.addins.buttons.unpublishAll')
						@include('recipes.addins.buttons.trashAll')
					@include('recipes.addins.pages.unpublished')
					@include('recipes.addins.pages.new')
					@include('recipes.addins.pages.future')
					@include('recipes.addins.pages.trashed')
					@include('recipes.addins.pages.mine')
					@include('recipes.addins.pages.myPrivate')
				</span>
			</div>

			@if($recipes->count() > 0)
				<div class="card-body card_body p-2">
					@include('recipes.alphabet_2', ['model'=>'recipe', 'page'=>'published'])
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
								<td><a href="{{ route('recipes.view', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
								<td>{{ ucwords($recipe->category->name) }}</td>
								<td>{{ $recipe->views }}</td>
								<td>{{ \App\Models\Recipes\Recipe::withTrashed()->find($recipe->id)->favoritesCount }}</td>
								<td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
								<td class="text-right">
									@include('recipes.addins.links.edit', ['size'=>'xs'])
									{{-- @include('recipes.addins.links.publish', ['size'=>'xs']) --}}
									@include('recipes.addins.links.trash', ['size'=>'xs'])
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

@section('scripts')
	@include('scripts.bulkButtons')
@endsection