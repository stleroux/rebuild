@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('admin.articles.sidebar')
	@include('admin.articles.blocks.archives')
@endsection

@section('content')

	<form style="display:inline;">
		{!! csrf_field() !!}
		
	<div class="row">
      <div class="col">
         <div class="card mb-3">

				<div class="card-header section_header p-2">
					<i class="fa fa-file-text-o"></i>
					New Articles
					@include('admin.articles.buttons.help', ['size'=>'xs', 'bookmark'=>'articles'])
					@include('admin.articles.buttons.add', ['size'=>'xs'])
				</div>

				@if($articles->count())
					{{-- @include('admin.articles.newArticles.alphabet') --}}
					<div class="well well-sm text text-center" style="padding-top:4px; padding-bottom:4px; margin-top:0px; margin-bottom:0px;">
						<a href="{{ route('admin.articles.newArticles') }}" class="{{ Request::is('admin/articles/newArticles') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
						@foreach($letters as $value)
							<a href="{{ route('admin.articles.newArticles', $value) }}" class="{{ Request::is('admin/articles/newArticles/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
						@endforeach
					</div>
				@endif

				<div class="card-body section_body p-2">
					@if($articles->count())

						{{-- @include('admin.articles.newArticles.help') --}}
						
						<div class="panel-body">
							@if($articles->count())
								{{-- @include('admin.articles.newArticles.datagrid') --}}
								<table id="datatable" class="table table-hover table-sm searchHighlight">
									<thead>
										<tr>
											<th><input type="checkbox" id="selectall" class="checked" /></th>
											{{-- Add columns for search purposes only --}}
											<th class="d-none">English</th>
											<th class="d-none">French</th>
											{{-- Add columns for search purposes only --}}

											<th><div>Title</div></th>
											<th class="hidden-xs">Category</th>
											<th class="hidden-xs hidden-sm">Views</th>
											<th class="hidden-xs">Author</th>
											<th class="hidden-sm hidden-xs">Created On</th>
											<th class="hidden-sm hidden-xs">Publish(ed) On</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($articles as $key => $article)
											<tr>
												<td>
													<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all">
												</td>
												{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
												<td class="d-none">{{ $article->description_eng }}</td>
												<td class="d-none">{{ $article->description_fre }}</td>
												{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
												
												<td><a href="{{ route('admin.articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
												<td class="hidden-xs">{{ $article->category }}</td>
												<td class="hidden-xs hidden-sm">{{ $article->views }}</td>
												<td class="hidden-xs">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
												<td class="hidden-sm hidden-xs">@include('common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
												<td class="hidden-sm hidden-xs 
														{{ $article->published_at >= Carbon\Carbon::now() ? 'text text-warning' : '' }}
														{{ $article->published_at == null ? 'text text-info' : '' }}
												">
													@include('common.dateFormat', ['model'=>$article, 'field'=>'published_at'])
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@else
								{{ setting('no_records_found') }}
							@endif
						</div>
					@else
						{{ setting('no_records_found') }}
					@endif
				</div>
			</div>
		</div>
	</div>
	
	</form>

@endsection
{{-- 
@section('blocks')
		@include('articles.newArticles.controls')
@endsection --}}

{{-- @section('scripts')
	@include('articles.newArticles.scripts')
@endsection --}}