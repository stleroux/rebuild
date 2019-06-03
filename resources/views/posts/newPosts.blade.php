@extends('layouts.backend')

@section('stylesheets')
	{{-- {{ Html::style('css/woodbarn.css') }} --}}
@stop

@section('left_column')
   @include('blocks.adminNav')
   @include('posts.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}
		
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header card_header">
								<i class="fas fa-dot-circle"></i>
								New Posts
							<div class="float-right">
								@if(checkPerm('post_create'))
									<button
										class="btn btn-sm btn-outline-danger px-1 py-0"
										type="submit"
										formaction="{{ route('posts.trashAll') }}"
										formmethod="POST"
										id="bulk-trash"
										style="display:none; margin-left:2px"
										onclick="return confirm('Are you sure you want to trash these posts?')">
										<i class="far fa-trash-alt"></i>
										Trash Selected
									</button>
															
									<button
										class = "btn btn-sm btn-outline-secondary px-1 py-0"
										type="submit"
										formaction="{{ route('posts.publishAll') }}"
										formmethod="POST"
										id="bulk-publish"
										style="display:none; margin-left:2px"
										onclick="return confirm('Are you sure you want to unpublish these posts?')">
										<i class="fa fa-download"></i>
										Publish Selected
									</button>

									@include('common.buttons.add', ['model'=>'post'])
								@endif
							</div>
						</div>
					

					<div class="card-body card_body">
						@if($posts->count() > 0)
							@include('common.alphabet', ['model'=>'post', 'page'=>'newPosts'])
							<table id="datatable" class="table table-hover table-sm">
								<thead>
									<tr>
										<th><input type="checkbox" id="selectall" class="checked" /></th>
										<th>ID</th>
										<th>Title</th>
										<th>Category</th>
										{{-- <th>Views</th> --}}
										<th>Created By</th>
										<th>Created On</th>
										{{-- @if(checkACL('author')) --}}
										<th data-orderable="false"></th>
										{{-- @endif --}}
									</tr>
								</thead>
								<tbody>
									@foreach ($posts as $post)
									<tr>
										<td>
											<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{ $post->id }}" class="check-all">
										</td>
										<td>{{ $post->id }}</td>
										<td>{{ $post->title }}</td>
										<td>{{ $post->category->name }}</td>
										{{-- <td>{{ $post->views }}</td> --}}
										<td>{{ ucfirst($post->user->username) }}</td>
										<td>{{ $post->created_at->format('M d, Y') }}</td>										
										{{-- @if(checkACL('author')) --}}
										<td class="text-right">
											@include('common.buttons.show', ['model'=>'post', 'id'=>$post->id])
											@include('common.buttons.publish', ['model'=>'post', 'id'=>$post->id])
											@if(checkPerm('post_edit', $post))
												@include('common.buttons.edit', ['model'=>'post', 'id'=>$post->id])
											@endif
											@if(checkPerm('post_delete', $post))
												@include('common.buttons.trash', ['model'=>'post', 'id'=>$post->id])
											@endif
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
											$(".selectmenu").hide();

									} else {
											$("input[type=checkbox]").each(function () {
													 $(this).attr("checked", false);
											});
											$("#bulk-trash").hide();
											$("#bulk-publish").hide();
											$(".selectmenu").show();
									}
						 });
				 });

				 function checkbox_is_checked() {

						 if ($(".check-all:checked").length > 0)
						 {
									$("#bulk-trash").show();
									$("#bulk-publish").show();
									$(".selectmenu").hide();
						 }
						 else
						 {
									$("#bulk-trash").hide();
									$("#bulk-publish").hide();
									$(".selectmenu").show();
						 }
				 };

		</script>

@stop