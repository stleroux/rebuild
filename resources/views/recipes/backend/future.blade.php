@extends('layouts.backend')

@section('stylesheets')
	 {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
	 {{-- @include('blocks.adminNav') --}}
	 {{-- @include('recipes::backend.sidebar') --}}
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
               @include('common.buttons.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
               {{-- @include('recipes::backend.future.help') --}}
               @include('common.buttons.add', ['model'=>'recipe', 'type'=>''])

					<button
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
					</button>
				</span>
			</div>

			@if($recipes->count() > 0)
				<div class="card-body card_body p-2">
					@include('common.alphabet', ['model'=>'recipe', 'page'=>'future'])
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
					         <td><a href="{{ route('recipes.show', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
					         <td>{{ ucwords($recipe->category->name) }}</td>
					         <td>{{ $recipe->views }}</td>
					         <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
					         <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
					         <td class="text-right">
					            @include('common.buttons.edit', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
					            @include('common.buttons.restore', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
					            @include('common.buttons.trash', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
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
@stop
