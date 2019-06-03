@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blog.blocks.search')
   @include('blocks.popularPosts')
   @include('blog.blocks.archives')
@endsection

@section ('content')
	
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header section_header">
					BLOG ARCHIVES FOR  
					@if ($month == 1) JANUARY @endif
					@if ($month == 2) FEBRUARY @endif
					@if ($month == 3) MARCH @endif
					@if ($month == 4) APRIL @endif
					@if ($month == 5) MAY @endif
					@if ($month == 6) JUNE @endif
					@if ($month == 7) JULY @endif
					@if ($month == 8) AAUGUST @endif
					@if ($month == 9) SEPTEMBER @endif
					@if ($month == 10) OCTOBER @endif
					@if ($month == 11) NOVEMBER @endif
					@if ($month == 12) DECEMBER @endif
					{{ $year }}

					<span class="float-right">
						@if (true !== stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
							<a href="{{ route('blog.index') }}" class="btn btn-sm btn-block btn-primary px-1 py-0">
								<i class="fas fa-blog"></i> Blog
							</a>
						@endif
					</span>
				</div>
				<div class="card-body section_body">
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th>Title</th>
								<th>Created On</th>
								<th>Author</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($archives as $archive)
								<tr>
									<td>{{ $archive->title }}</td>
									{{-- <td>@include('common.author', ['model'=>$archive, 'field'=>'user'])</td> --}}
									{{-- <td><a href="" data-toggle="modal" data-target="#viewAuthorModal">{{ $archive->user->username }}</a></td> --}}
									<td>
										{{-- @include('common.dateFormat', ['model'=>$archive, 'field'=>'created_at']) --}}
										{{ date('M j, Y', strtotime($archive->created_at)) }}</td>
									</td>
									<td>
										{{-- @include('common.authorFormat', ['model'=>$archive, 'field'=>'user']) --}}
										{{ $archive->user->username }}
									</td>
									<td class="text-right">
										<a href="{{ route('blog.single', $archive->slug) }}" class="btn btn-sm btn-secondary px-1 py-0" title="View Blog">
											<i class="fa fa-eye"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{-- <div class="col-xs-12 col-sm-4 col-md-3">
			@include('blog.archive.controls')
			@include('blog.blocks.archives')
		</div> --}}
	</div>
	
@stop

@section ('scripts')
@stop
