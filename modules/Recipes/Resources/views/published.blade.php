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
					@include('common.buttons.help')
					@include('recipes::published.help')
					@include('common.buttons.add', ['model'=>'recipe'])
					@include('common.buttons.unpublishAll', ['model'=>'recipe'])
					@include('common.buttons.trashAll', ['model'=>'recipe'])
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

			@if($recipes->count() > 0)
				<div class="card-body card_body px-1 py-0">
					<table id="datatable" class="table table-sm table-hover">
						<thead>
							<tr>
								 <th><input type="checkbox" id="selectall" class="checked" /></th>
								<th>Name</th>
								<th>Category</th>
								<th>Views</th>
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
								<td>{{ $recipe->category->name }}</td>
								<td>{{ $recipe->views }}</td>
								<td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
								<td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
								<td class="text-right">
										@include('common.buttons.edit', ['model'=>'recipe', 'id'=>$recipe->id])
										@include('common.buttons.makePrivate', ['model'=>'recipe', 'id'=>$recipe->id, 'type'=>''])
										{{-- @if(\Request::is('*/trashed')) --}}
											{{-- @include('common.buttons.delete', ['model'=>'recipe', 'id'=>$recipe->id]) --}}
										{{-- @else --}}
											@include('common.buttons.trash', ['model'=>'recipe', 'id'=>$recipe->id])
										{{-- @endif --}}
									{{-- {!! Form::close() !!} --}}
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

{{-- 	<script>
		$(function () {
			$("#selectall").click(function () {
				if ($("#selectall").is(':checked')) {
					$("input[type=checkbox]").each(function () {
						$(this).attr("checked", true);
					});
					$("#bulk-trash").show();
					$("#bulk-restore").show();
					$("#bulk-unpublish").show();
					$("#bulk-publish").show();
					$(".selectmenu").hide();

				} else {
					$("input[type=checkbox]").each(function () {
						$(this).attr("checked", false);
					});
					$("#bulk-trash").hide();
					$("#bulk-restore").hide();
					$("#bulk-unpublish").hide();
					$("#bulk-publish").hide();
					$(".selectmenu").show();
				}
			});
		});

		function checkbox_is_checked() {

			if ($(".check-all:checked").length > 0)
			{
				$("#bulk-trash").show();
				$("#bulk-restore").show();
				$("#bulk-unpublish").show();
				$("#bulk-publish").show();
				$(".selectmenu").hide();
			}
			else
			{
				$("#bulk-trash").hide();
				$("#bulk-restore").hide();
				$("#bulk-unpublish").hide();
				$("#bulk-publish").hide();
				$(".selectmenu").show();
			}
		};
	</script> --}}
@stop