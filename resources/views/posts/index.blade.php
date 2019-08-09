@extends('layouts.master')

@section('stylesheets')
	{{-- {{ Html::style('css/woodbarn.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}

		<div class="row">
			<div class="col">
				<div class="card mb-2">
					<div class="card-header section_header p-2">
						<i class="fas fa-upload"></i>
						Published Posts
						<div class="float-right">
							@if(checkPerm('post_create'))
								<button
									class="btn btn-xs btn-danger p-1"
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
									class="btn btn-xs btn-secondary p-1"
									type="submit"
									formaction="{{ route('posts.unpublishAll') }}"
									formmethod="POST"
									id="bulk-unpublish"
									style="display:none; margin-left:2px"
									onclick="return confirm('Are you sure you want to unpublish these posts?')">
									<i class="fa fa-download"></i>
									Unpublish Selected
								</button>

								@include('posts.buttons.unpublished', ['size'=>'xs'])
								@include('posts.buttons.add', ['size'=>'xs'])
								{{-- @include('posts.buttons.trashed', ['size'=>'xs']) --}}
								{{-- @include('posts.buttons.newPosts', ['size'=>'xs']) --}}
							@endif
						</div>
					</div>
					

					
					@if($posts->count() > 0)
						<div class="card-body section_body p-2">
							@include('common.alphabet', ['model'=>'post', 'page'=>'index'])
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
											<td>{{ ucwords($post->category->name) }}</td>
											<td>{{ $post->views }}</td>
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
												@include('posts.buttons.unpublish', ['size'=>'xs'])

												{{-- <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0" title="View Post">
													<i class="fa fa-eye"></i>
												</a> --}}
												@include('posts.buttons.show', ['size'=>'xs'])

												@if(checkPerm('post_edit', $post))
													@include('posts.buttons.edit', ['size'=>'xs'])
												@endif
												@if(checkPerm('post_delete', $post))
													@include('posts.buttons.trash', ['size'=>'xs'])
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
	@include('scripts.bulkButtons')
@stop