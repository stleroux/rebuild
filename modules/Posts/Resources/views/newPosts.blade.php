@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/posts.css') }}
@stop

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
	{{-- @include('posts::blocks.search') --}}
	{{-- @include('posts::blocks.archives') --}}
	{{-- @include('posts::blocks.leaveComment') --}}
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

									<a href="{{ route('posts.create') }}" class="btn btn-sm btn-outline-success px-1 py-0">
										<i class="fas fa-plus-square"></i>
										New Post
									</a>
								@endif
							</div>
						</div>
					

					<div class="card-body card_body">
						@if($posts->count() > 0)
							<div class="card mb-2 bg-transparent border-0 pt-0 py-0">
								<div class="card-body px-0 py-0 text-center">
									<div class="btn-group" role="group">
									<a href="{{ route('posts.newPosts') }}" class="{{ Request::is('posts/newPosts') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
									@foreach($letters as $value)
										<a href="{{ route('posts.newPosts', $value) }}" class="{{ Request::is('posts/newPosts/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
									@endforeach
									</div>
								</div>
							</div>
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
											<a href="{{ route('posts.publish', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="Publish Post">
												<i class="fa fa-upload"></i>
											</a>

											{{-- <a href="{{ route('posts.unpublish', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="Unpublish Post">
												<i class="fa fa-download"></i>
											</a> --}}

											<a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="View Post">
												<i class="fa fa-eye"></i>
											</a>

											@if(checkPerm('post_edit', $post))
												<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-bprimary px-1 py-0" title="Edit Post">
													<i class="far fa-edit"></i>
												</a>
											@endif
											@if(checkPerm('post_delete', $post))
												<a href="{{ route('posts.trash', $post->id) }}" class="btn btn-sm btn-outline-danger px-1 py-0" title="Trash Post">
													<i class="far fa-trash-alt"></i>
												</a>
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