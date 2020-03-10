@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.movies.blocks.sidebar')
	@include('admin.movies.blocks.archives')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}
		
         <div class="card mb-3">

				<div class="card-header section_header p-2">
					<i class="{{ Config::get('buttons.new') }}"></i>
					New Movies
					<span class="float-right">
            		<div class="btn-group">
							@include('admin.movies.buttons.help', ['size'=>'xs', 'bookmark'=>'movies'])
							@include('admin.movies.buttons.unpublishAll', ['size'=>'xs'])
							@include('admin.movies.buttons.trashAll', ['size'=>'sm'])
							@include('admin.movies.buttons.add', ['size'=>'xs'])
						</div>
					</span>
				</div>

				@if($movies->count())
					<div class="text-center">
						<div class="btn-group p-1">
							<a href="{{ route('admin.movies.newMovies') }}" class="{{ Request::is('admin/movies/newMovies') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
							@foreach($letters as $value)
								<a href="{{ route('admin.movies.newMovies', $value) }}" class="{{ Request::is('admin/movies/newMovies/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
							@endforeach
						</div>
					</div>
				@endif

				<div class="card-body section_body p-2">
					@if($movies->count())
						<table id="datatable" class="table table-hover table-sm searchHighlight">
							<thead>
								<tr>
									<th><input type="checkbox" id="selectall" class="checked" /></th>
									{{-- Add columns for search purposes only --}}
										{{-- <th class="d-none">English</th> --}}
										{{-- <th class="d-none">French</th> --}}
									{{-- Add columns for search purposes only --}}
									<th>Title</th>
									<th class="hidden-xs">Category</th>
									<th class="hidden-xs hidden-sm">Views</th>
									<th class="hidden-xs">Author</th>
									<th class="hidden-sm hidden-xs">Created On</th>
									<th class="hidden-sm hidden-xs">Publish(ed) On</th>
									<th data-orderable="false"></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($movies as $key => $movie)
									<tr>
										<td>
											<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$movie->id}}" class="check-all">
										</td>
										{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
											{{-- <td class="d-none">{{ $movie->description_eng }}</td> --}}
											{{-- <td class="d-none">{{ $movie->description_fre }}</td> --}}
										{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
										<td><a href="{{ route('admin.movies.show', $movie->id) }}" class="">{{ $movie->title }}</a></td>
										<td>{{ $movie->category }}</td>
										<td class="hidden-xs hidden-sm">{{ $movie->views }}</td>
										<td class="hidden-xs">@include('common.authorFormat', ['model'=>$movie, 'field'=>'user'])</td>
										<td data-order="{{ $movie->created_at }}">{{ $movie->created_at }}</td>
										<td data-order="{{ $movie->published_at }}">{{ $movie->published_at }}</td>
										<td>
											<div class="float-right">
		                              <div class="btn-group">
		                                 @include('admin.movies.buttons.publish', ['size'=>'xs'])
		                                 @include('admin.movies.buttons.edit', ['size'=>'xs'])
		                                 @include('admin.movies.buttons.trash', ['size'=>'xs'])
		                              </div>
		                           </div>
										</td>
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

@endsection
