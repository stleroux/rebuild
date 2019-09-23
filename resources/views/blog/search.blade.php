@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	{{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
	@include('blog.blocks.search')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
@endsection

@section ('content')
	<div class="card mb-2">
		<div class="card-header section_header p-2">
			<i class="fas fa-blog"></i>
			Blog Search Results
			<span class="float-right">
				<!-- Only show the Search Results button if coming from the search results page -->
				@if (false !== stripos($_SERVER['HTTP_REFERER'], "/blog/search"))
					<a href="{{ URL::previous() }}" class="btn btn-sm btn-primary px-1 py-0">
						<i class="fa fa-arrow-left"></i> Search Results
					</a>
				@endif
				@if (true !== stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
					<a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary text-light px-1 py-0">
						<i class="fas fa-blog"></i> Blog
					</a>
				@endif
			</span>
		</div>
		<div class="card-body card p-2">
			@if (count($posts) > 0)
				<table class="table table-hover table-sm text-light">
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
										@include('blog.buttons.show', ['size'=>'xs'])
									</td>
								</tr>
							@endforeach
						</tbody>
				</table>
				<!-- Display pagination links -->
				<div class="text-center">{!! $posts->render() !!}</div>
			@else
				<p class="text text-light"><b>No results found</b></p>
			@endif
		</div>
	</div>
@endsection
