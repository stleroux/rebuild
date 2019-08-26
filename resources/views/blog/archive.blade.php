@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blog.blocks.search')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
@endsection

@section ('content')
	
	<div class="card mb-2">
		<div class="card-header section_header p-2">
			Blog Archives For  
			@if ($month == 1) January @endif
			@if ($month == 2) February @endif
			@if ($month == 3) March @endif
			@if ($month == 4) April @endif
			@if ($month == 5) May @endif
			@if ($month == 6) June @endif
			@if ($month == 7) July @endif
			@if ($month == 8) August @endif
			@if ($month == 9) September @endif
			@if ($month == 10) Ootober @endif
			@if ($month == 11) November @endif
			@if ($month == 12) December @endif
			{{ $year }}

			<span class="float-right">
				@if (true == stripos($_SERVER['HTTP_REFERER'], "/search/posts"))
					<a href="{{ route('blog.index') }}" class="btn btn-sm btn-block btn-primary px-2 py-0">
						<i class="fas fa-blog"></i> Blog
					</a>
				@endif
				{{-- @include('blog.buttons.back', ['size'=>'xs']) --}}
			</span>
		</div>
		<div class="card-body section_body p-2 text-light">
			<table class="table table-sm table-hover text-light">
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
							<td>
								@include('common.dateFormat', ['model'=>$archive, 'field'=>'created_at'])
							</td>
							<td>
								@include('common.authorFormat', ['model'=>$archive, 'field'=>'user'])
							</td>
							<td class="text-right">
								<div class="btn-group">
									@include('blog.buttons.archiveShow', ['size'=>'xs'])
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section ('scripts')
@endsection
