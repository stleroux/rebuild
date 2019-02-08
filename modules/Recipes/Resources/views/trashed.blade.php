@extends('layouts.master')

@section ('stylesheets')
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
	{!! csrf_field() !!}
	
	{{-- @if($recipes->count() > 0) --}}
		<div class="card mb-3">
			<div class="card-header">
				Trashed Recipes
				{{-- <a href="#" id="popover" data-toggle="popover" data-trigger="hover"
					data-title="Trashed Recipes"
					data-content="These recipes have been marked as deleted and cannot be viewed by frontend users.">
					<i class="fa fa-question-circle" aria-hidden="true"></i> Trashed Recipes
				</a> --}}
				<span class="float-right">
               <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#help">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                  Help
               </button>

					<button
						class="btn btn-sm btn-danger"
						type="submit"
						formaction="{{ route('recipes.deleteAll') }}"
						formmethod="POST"
						id="bulk-delete"
						style="display:none">
							Delete Selected
					</button>
					
					<button
						class="btn btn-xs btn-primary"
						type="submit"
						formaction="{{ route('recipes.restoreAll') }}"
						formmethod="POST"
						id="bulk-restore"
						style="display:none">
							Restore Selected
					</button>

					<button
						class="btn btn-xs btn-secondary"
						type="submit"
						formaction="{{ route('recipes.publishAll') }}"
						formmethod="POST"
						id="bulk-publish"
						style="display:none">
							Publish Selected
					</button>

			</div>
	</form>
			
			
			<div class="card-body card_body px-1 py-2">
            @if($recipes->count() > 0)
                  @include('recipes::datagrid')
            @else
               {{ setting('no_records_found') }}
            @endif
         </div>
			

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
	{{-- @else
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Trashed Articles</h3>
			</div>
			<div class="panel-body">
				<div class="text text-danger">{{ setting('no_records_found') }}</div>
			</div>
		</div>
	@endif --}}

	@include('recipes::trashed.help')

@stop



@section('scripts')

	<script>
		$(function () {
			$("#selectall").click(function () {
				if ($("#selectall").is(':checked')) {
					$("input[type=checkbox]").each(function () {
						$(this).attr("checked", true);
					});
					$("#bulk-delete").show();
					$("#bulk-restore").show();
					$("#bulk-publish").show();
					$(".selectmenu").hide();

				} else {
					$("input[type=checkbox]").each(function () {
						$(this).attr("checked", false);
					});
					$("#bulk-delete").hide();
					$("#bulk-restore").hide();
					$("#bulk-publish").hide();
					$(".selectmenu").show();
				}
			});
		});

		function checkbox_is_checked() {

			if ($(".check-all:checked").length > 0)
			{
				$("#bulk-delete").show();
				$("#bulk-restore").show();
				$("#bulk-publish").show();
				$(".selectmenu").hide();
			}
			else
			{
				$("#bulk-delete").hide();
				$("#bulk-restore").hide();
				$("#bulk-publish").hide();
				$(".selectmenu").show();
			}
		};
	</script>
@stop