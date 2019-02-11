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
	{!! csrf_field() !!}
	
		<div class="card">
			<div class="card-header">
            <i class="fas fa-address-card"></i>
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