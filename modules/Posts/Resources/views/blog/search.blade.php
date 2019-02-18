@extends('layouts.master')

@section ('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@stop

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
	 @include('posts::blog.blocks.search')
	 @include('posts::blog.blocks.archives')
	 {{-- @include('posts::blog.blocks.leaveComment') --}}
	 {{-- @include('blog.single.image') --}}
@stop

@section ('content')
	<div class="row">
		<div class="col">
			<div class="card mb-2">
				<div class="card-header card_header">
					<i class="fas fa-blog"></i>
					Blog Search Results
					<span class="float-right">
						<!-- Only show the Search Results button if coming from the search results page -->
						@if (false !== stripos($_SERVER['HTTP_REFERER'], "/blog/search"))
							<a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
								<i class="fa fa-arrow-left"></i> Search Results
							</a>
						@endif
						@if (true !== stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
							<a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
								<i class="fas fa-blog"></i> Blog
							</a>
						@endif
					</span>
				</div>
				<div class="card-body card_body">
					@if (count($posts) > 0)
						{{-- <div class="row"> --}}
							{{-- <div class="col-md-12"> --}}
								<table class="table table-hover table-sm">
									<thead>
										<th>Title</th>
										{{-- <th>Body</th> --}}
										<th>Created On</th>
										<th>Author</th>
										<th></th>
									</thead>
									<tbody>
										@foreach ($posts as $post)
											<tr>
												<td>{{ $post->title }}</td>
												{{-- <td>{!! substr($post->body, 0, 75) !!} {{ strlen($post->body) > 75 ? " ..." : "" }}</td> --}}
												<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
												<td>{{ $post->user->username }}</td>
												<td class="text-right">
													<a href="{{ route('blog.single', $post->slug) }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
														<i class="fa fa-eye"></i>
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								<!-- Display pagination links -->
								<div class="text-center">{!! $posts->render() !!}</div>
							{{-- </div> --}}
						{{-- </div> --}}
					@else
						{{-- <div class="row"> --}}
							{{-- <div class="col-md-12"> --}}
								<p class="text text-danger">No results found</p>
							{{-- </div> --}}
						{{-- </div> --}}
					@endif
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop
