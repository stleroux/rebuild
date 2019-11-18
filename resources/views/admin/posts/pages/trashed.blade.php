@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
	@include('admin.posts.sidebar')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}
			
		<div class="row">
			<div class="col">
				<div class="card mb-3">
					<div class="card-header section_header p-2">
						<i class="{{ Config::get('buttons.trashed') }}"></i>
						Trashed Posts
						<div class="float-right">
							<div class="btn-group">
								@include('admin.posts.buttons.deleteAll', ['size'=>'xs'])
								@include('admin.posts.buttons.restoreAll', ['size'=>'xs'])
								@include('admin.posts.buttons.add', ['size'=>'xs'])
							</div>
						</div>
					</div>

					@if($posts->count() > 0)
						<div class="card-body section_body p-2">
							 @include('admin.posts.alphabet', ['model'=>'post', 'page'=>'trashed'])
							 <table id="datatable" class="table table-hover table-sm">
								<thead>
									<tr>
										<th><input type="checkbox" id="selectall" class="checked" /></th>
										<th>ID</th>
										<th>Title</th>
										<th>Category</th>
										<th>Views</th>
										<th>Created By</th>
										<th>Created On</th>
										<th>Publish(ed) On</th>
										<th>Trashed On</th>
										<th data-orderable="false"></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($posts as $post)
										<tr>
											<td>
												<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{ $post->id }}" class="check-all">
											</td>
											<td>{{ $post->id }}</td>
											<td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
											<td>{{ $post->category->name }}</td>
											<td>{{ $post->views }}</td>
											<td>{{ ucfirst($post->user->username) }}</td>
											<td>{{ $post->created_at }}</td>
											<td>{{ $post->published_at }}</td>
											<td>{{ $post->deleted_at }}</td>
											<td class="text-right">
												<div class="btn-group">
													@include('admin.posts.buttons.show', ['size'=>'xs'])
											 		@include('admin.posts.buttons.restore', ['size'=>'xs'])
													@include('admin.posts.buttons.delete', ['size'=>'xs'])
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="card-body p-2">
							{{ setting('no_records_found') }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</form>

@endsection

@section('scripts')
   @include('scripts.bulkButtons')
@endsection

{{-- @section('scripts')

	<script>
		$(function () {
			$("#selectall").click(function () {
				if ($("#selectall").is(':checked')) {
					$("input[type=checkbox]").each(function () {
						$(this).attr("checked", true);
					});
					$("#bulk-delete").show();
					$("#bulk-restore").show();
					$(".selectmenu").hide();
				} else {
					$("input[type=checkbox]").each(function () {
						$(this).attr("checked", false);
					});
					$("#bulk-delete").hide();
					$("#bulk-restore").hide();
					$(".selectmenu").show();
				}
			});
		});

		function checkbox_is_checked() {
			if ($(".check-all:checked").length > 0) {
				$("#bulk-delete").show();
				$("#bulk-restore").show();
				$(".selectmenu").hide();
			} else {
				$("#bulk-delete").hide();
				$("#bulk-restore").hide();
				$(".selectmenu").show();
			}
		};

	</script>

@endsection --}}