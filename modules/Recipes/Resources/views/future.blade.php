@extends('layouts.master')

@section('stylesheets')
	 {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
	 {{-- @include('recipes::index.controls') --}}
	 @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

@section('content')
	<form style="display:inline;">
	{{-- <form method="POST" action="{{ route('articles.trashAll') }}"> --}}
	{{-- {!! csrf_field() !!} --}}
	
		<div class="card">
			<div class="card-header">
            <i class="fa fa-address-card-o"></i>
            Future Recipes
            <span class="float-right">
               <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#help">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                  Help
               </button>

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

			@include('recipes::future.help')

			@if($recipes->count() > 0)
				<div class="pt-1 text-center">
					 <a href="{{ route('recipes.future') }}" class="{{ Request::is('recipes/future') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
					 @foreach($letters as $value)
							<a href="{{ route('recipes.future', $value) }}" class="{{ Request::is('recipes/future/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
					 @endforeach
				</div>
			@endif

			<div class="card-body px-1 py-2">
				@if($recipes->count() > 0)
				 <table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								<th><input type="checkbox" id="selectall" class="checked" /></th>
								{{-- Add columns for search purposes only --}}
								<th class="d-none">Ingredients</th>
								<th class="d-none">Methodology</th>
								<th class="d-none">Public Notes</th>
								<th class="d-none">Source</th>
								{{-- Add columns for search purposes only --}}
								
								<th>Title</th>
								<th class="d-none">Category</th>
								<th class="d-none">Views</th>
								<th class="d-none">Author</th>
								<th class="d-none">Created On</th>
								<th>Publish On</th>
								{{-- @if(checkACL('author')) --}}
									<th data-orderable="false">xxx</th>
								{{-- @endif --}}
							</tr>
						</thead>
						<tbody>
							@foreach ($recipes as $recipe)
								<tr>
									<td>
										<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$recipe->id}}" class="check-all">
									</td>
									{{-- Add columns for search purposes only --}}
									<td class="d-none">{{ $recipe->ingredients }}</td>
									<td class="d-none">{{ $recipe->methodology }}</td>
									<td class="d-none">{{ $recipe->public_notes }}</td>
									<td class="d-none">{{ $recipe->source }}</td>
									{{-- Add columns for search purposes only --}}

									<td>
										<a href="{{ route('recipes.show', $recipe->id) }}">{{ ucfirst($recipe->title) }}</a>
									</td>
									<td class="d-none">{{ $recipe->category->name }}</td>
									<td class="d-none">{{ $recipe->views }}</td>
									<td class="d-none">
										{{-- @include('common.authorFormat', ['model'=>$recipe, 'field'=>'user']) --}}
									</td>
									<td class="d-none">
										{{-- @include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at']) --}}
									</td>
									<td>
										{{-- @include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at']) --}}
									</td>

									{{-- @if(checkACL('author')) --}}
										<td class="text-right">
												{{-- @include('layouts.partials.actionsDD', [
													 'model'=>$recipe,
													 'name'=>'recipes',
													 'params'=>['favorites', 'duplicate', 'resetViewCount', 'publish', 'edit', 'delete', 'permDelete','restore']
												]) --}}
												<a href="#" class="btn btn-xs" title="Edit">
													<i class="fa fa-pencil" aria-d-none="true"></i>
												</a>
												<a href="#" class="btn btn-xs" title="Trash">
													<i class="fa fa-trash-o" aria-d-none="true"></i>
												</a>
										</td>
									{{-- @endif --}}
								</tr>
							@endforeach
						</tbody>
				 </table>
				@else
					{{ setting('no_records_found') }}
				@endif
			</div>
	 </div>
</form>
@stop

@section('scripts')
	 <script>
			$(function () {
				 $("#selectall").click(function () {
						if ($("#selectall").is(':checked')) {
							 $("input[type=checkbox]").each(function () {
									$(this).attr("checked", true);
							 });
							 $("#bulk-trash").show();
							 $("#bulk-publish").show();
							 $("#bulk-unpublish").show();
							 $(".selectmenu").hide();

						} else {
							 $("input[type=checkbox]").each(function () {
									$(this).attr("checked", false);
							 });
							 $("#bulk-trash").hide();
							 $("#bulk-publish").hide();
							 $("#bulk-unpublish").hide();
							 $(".selectmenu").show();
						}
				 });
			});

			function checkbox_is_checked() {
				 if ($(".check-all:checked").length > 0)
				 {
						$("#bulk-trash").show();
						$("#bulk-publish").show();
						$("#bulk-unpublish").show();
						$(".selectmenu").hide();
				 }
				 else
				 {
						$("#bulk-trash").hide();
						$("#bulk-publish").hide();
						$("#bulk-unpublish").hide();
						$(".selectmenu").show();
				 }
			};
	 </script>
@stop