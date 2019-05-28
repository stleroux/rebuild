@extends('layouts.recipes')

@section('stylesheets')
	 {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')
	<form style="display:inline;">
	{!! csrf_field() !!}
	
		<div class="card">
			<div class="card-header">
            <i class="fas fa-address-card"></i>
            Future Recipes
            <span class="float-right">
               @include('recipes.buttons.help', ['bookmark'=>'recipes'])
               @include('recipes.buttons.add')

{{-- @include('recipes.buttons.btn_publishAll') --}}
@include('recipes.buttons.btn_unpublishAll')
@include('recipes.buttons.btn_trashAll')

{{-- 					<button
						class="btn btn-sm btn-danger px-1 py-0"
						type="submit"
						formaction="{{ route('recipes.trashAll') }}"
						formmethod="POST"
						id="bulk-trash"
						style="display:none;"
						onclick="return confirm('Are you sure you want to trash these recipes?')">
							 Trash  Selected
					</button>

					<button
						class="btn btn-sm btn-secondary px-1 py-0"
						type="submit"
						formaction="{{ route('recipes.unpublishAll') }}"
						formmethod="POST"
						id="bulk-unpublish"
						style="display:none;"
						onclick="return confirm('Are you sure you want to unpublish these recipes?')">
							 Unpublish Selected
					</button>

					<button
						class="btn btn-sm btn-secondary px-1 py-0"
						type="submit"
						formaction="{{ route('recipes.publishAll') }}"
						formmethod="POST"
						id="bulk-publish"
						style="display:none;"
						onclick="return confirm('Are you sure you want to publish these recipes?')">
							 Publish Selected
					</button> --}}

					@include('recipes.buttons.published')
               @include('recipes.buttons.unpublished')
               @include('recipes.buttons.new')
               @include('recipes.buttons.trashed')
               @include('recipes.buttons.mine')
               @include('recipes.buttons.private')
				</span>
			</div>

			@if($recipes->count() > 0)
				<div class="card-body card_body p-2">
					@include('recipes.alphabet_2', ['model'=>'recipe', 'page'=>'future'])
					<table id="datatable" class="table table-sm table-hover">
					   <thead>
					      <tr>
					          <th><input type="checkbox" id="selectall" class="checked" /></th>
					         <th>Name</th>
					         <th>Category</th>
					         <th>Views</th>
					         <th>Author</th>
					         <th>Created On</th>
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
					         <td><a href="{{ route('recipes.view', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
					         <td>{{ ucwords($recipe->category->name) }}</td>
					         <td>{{ $recipe->views }}</td>
					         <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
					         <td class="text-right">
					            @include('recipes.buttons.edit', ['size'=>'xs'])
					            @include('recipes.buttons.publish', ['size'=>'xs'])
					            @include('recipes.buttons.trash', ['size'=>'xs'])
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