@extends('layouts.backend')

@section('stylesheets')
	{{ Html::style('css/posts.css') }}
@endsection

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
						<i class="fas fa-upload"></i>
						Published Posts
						<div class="float-right">
							@if(checkPerm('post_create'))
								<button
									class="btn btn-sm btn-outline-danger px-1 py-0"
									type="submit"
									formaction="{{ route('posts.trashAll') }}"
									formmethod="POST"
									id="bulk-delete"
									style="display:none; margin-left:2px"
									onclick="return confirm('Are you sure you want to trash these posts?')">
									<i class="far fa-trash-alt"></i>
									Trash Selected
								</button>
														
								<button
									class = "btn btn-sm btn-outline-secondary px-1 py-0"
									type="submit"
									formaction="{{ route('posts.unpublishAll') }}"
									formmethod="POST"
									id="bulk-unpublish"
									style="display:none; margin-left:2px"
									onclick="return confirm('Are you sure you want to unpublish these posts?')">
									<i class="fa fa-download"></i>
									Unpublish Selected
								</button>

								@include('common.buttons.add', ['model'=>'post'])
							@endif
						</div>
					</div>
					

					
					@if($posts->count() > 0)
						<div class="card-body card_body p-2">
							@include('common.alphabet', ['model'=>'post', 'page'=>'index'])
							<table id="datatable" class="table table-hover table-sm">
								<thead>
									<tr>
										<th><input type="checkbox" id="selectall" class="checked" /></th>
										<th>ID</th>
										<th>Title</th>
										<th>Category</th>
										<th>Created By</th>
										<th>Created On</th>
										<th>Published</th>
										{{-- <th>Slug</th> --}}
										{{-- <th>Category</th> --}}
										{{-- <th>Views</th> --}}
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
											<td>@include('common.authorFormat', ['model'=>$post, 'field'=>'user'])</td>
											<td>@include('common.dateFormat', ['model'=>$post, 'field'=>'created_at'])</td>
											<td>
												{{-- {{ $post->published_at ? $post->published_at->format('M d Y') : '' }} --}}
												@include('common.dateFormat', ['model'=>$post, 'field'=>'published_at'])
												{{-- {{ date('M d Y', strtotime($post->published_at) ?? 'N/A')  }} --}}
												{{-- {{ \Carbon\Carbon::parse($post->published_at)->format('M d Y')}} --}}
											</td>
											{{-- <td>{{ $post->slug }}</td> --}}
											{{-- <td>{{ $post->category->name }}</td> --}}
											{{-- <td>{{ $post->views }}</td> --}}
											<td class="text-right">
												{{-- <a href="{{ route('posts.publish', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="Publish Post">
													<i class="fa fa-upload"></i>
												</a> --}}

												{{-- <a href="{{ route('posts.unpublish', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="Unpublish Post">
													<i class="fa fa-download"></i>
												</a> --}}
												@include('common.buttons.unpublish', ['model'=>'post', 'id'=>$post->id])

												{{-- <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="View Post">
													<i class="fa fa-eye"></i>
												</a> --}}
												@include('common.buttons.show', ['model'=>'post', 'id'=>$post->id])

												@if(checkPerm('post_edit', $post))
													@include('common.buttons.edit', ['model'=>'post', 'id'=>$post->id])
												@endif
												@if(checkPerm('post_delete', $post))
													@include('common.buttons.trash', ['model'=>'post', 'id'=>$post->id])
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="card-body">
							{{ setting('no_records_found') }}
						</div>
					@endif
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
																 $("#bulk-delete").show();
																 $("#bulk-unpublish").show();
																 $(".selectmenu").hide();

													 } else {
																 $("input[type=checkbox]").each(function () {
																				$(this).attr("checked", false);
																 });
																 $("#bulk-delete").hide();
																 $("#bulk-unpublish").hide();
																 $(".selectmenu").show();
													 }
									 });
						 });

						 function checkbox_is_checked() {

									 if ($(".check-all:checked").length > 0)
									 {
													 $("#bulk-delete").show();
													 $("#bulk-unpublish").show();
													 $(".selectmenu").hide();
									 }
									 else
									 {
													 $("#bulk-delete").hide();
													 $("#bulk-unpublish").hide();
													 $(".selectmenu").show();
									 }
						 };

			</script>

@stop