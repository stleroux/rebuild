@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('tests.blocks.archives')
@endsection

@section('content')

	<div class="card">
		
		<div class="card-header section_header p-2">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Tests Archives for 
			@if ($month == 1) January @endif
			@if ($month == 2) February @endif
			@if ($month == 3) March @endif
			@if ($month == 4) April @endif
			@if ($month == 5) May @endif
			@if ($month == 6) June @endif
			@if ($month == 7) July @endif
			@if ($month == 8) August @endif
			@if ($month == 9) September @endif
			@if ($month == 10) October @endif
			@if ($month == 11) November @endif
			@if ($month == 12) December @endif
			{{ $year }}
			<div class="float-right">
            <div class="btn-group">
               @include('tests.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
            </div>
         </div>
		</div>

		<div class="card-body section_body p-2">
			<table id="datatable" class="table table-hover table-sm">
				<thead>
					<tr>
						<th>Name</th>
						<th>Category</th>
						<th>Views</th>
						<th>Author</th>
						<th>Created On</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($archives as $archive)
						<tr>
							<td><a href="{{ route('tests.show', $archive->id) }}">{{ $archive->name }}</a></td>
							<td>{{ $archive->category }}</td>
							<td>{{ $archive->views }}</td>
							<td>@include('common.authorFormat', ['model'=>$archive, 'field'=>'user'])</td>
							<td>@include('common.dateFormat', ['model'=>$archive, 'field'=>'created_at'])</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
