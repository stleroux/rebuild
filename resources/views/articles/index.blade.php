@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
	{{-- @include('articles.sidebar') --}}
	@include('articles.blocks.archives')
@endsection

@section('content')

	<div class="row">
      <div class="col">
         <div class="card mb-3">
				<div class="card-header section_header p-2">
					<i class="fa fa-file-text-o"></i>
					Articles
					<span class="float-right">
		            <div class="btn-group">
		               @include('articles.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
		               @include('articles.buttons.myFavorites', ['size'=>'xs', 'btn_label'=>'Favorites'])
		            </div>
		         </span>
				</div>
				
				@if($articles->count())
					<div class="text-center">
						<div class="btn-group p-1">
							<a href="{{ route('articles.index') }}" class="{{ Request::is('articles') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
							@foreach($letters as $value)
								<a href="{{ route('articles.index', $value) }}" class="{{ Request::is('articles/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
							@endforeach
						</div>
					</div>
				@endif

				<div class="card-body section_body p-2">
					@if($articles->count())
						<table id="datatable" class="table table-hover table-sm searchHighlight">
							<thead>
								<tr>
									{{-- <th data-orderable="false"><input type="checkbox" id="selectall" class="checked" /></th> --}}
									{{-- Add columns for search purposes only --}}
									<th class="d-none">English</th>
									<th class="d-none">French</th>
									{{-- Add columns for search purposes only --}}
									<th>Title</th>
									<th class="">Category</th>
									<th class="">Views</th>
									<th class="">Author</th>
									<th class="">Created On</th>
									<th class="">Publish(ed) On</th>
									<th data-orderable="false"></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($articles as $key => $article)
									<tr>
										{{-- @if(checkACL('editor')) --}}
											{{-- <td>
												<input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$article->id}}" class="check-all">
											</td> --}}
										{{-- @endif --}}
										{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
										<td class="d-none">{{ $article->description_eng }}</td>
										<td class="d-none">{{ $article->description_fre }}</td>
										{{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
										
										<td><a href="{{ route('articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
										<td class="">{{ $article->category }}</td>
										<td class="">{{ $article->views }}</td>
										<td class="">@include('common.authorFormat', ['model'=>$article, 'field'=>'user'])</td>
										<td class="">@include('common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
										<td class=" 
											{{ $article->published_at >= Carbon\Carbon::now() ? 'text text-warning' : '' }}
											{{ $article->published_at == null ? 'text text-info' : '' }}
										">
											@include('common.dateFormat', ['model'=>$article, 'field'=>'published_at'])
										</td>
										<td>@include('articles.buttons.favorite', ['size'=>'xs'])</td>
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

@endsection

{{-- @section('scripts')
	@include('articles.common.btnScript')
@stop --}}