<div class="card mb-2">
	<div class="card-header">
		<i class="fa fa-address-card-o" aria-hidden="true"></i>
		Recipe Archives for 
		@if ($month == 1) January 
		@elseif ($month == 2) February 
		@elseif ($month == 3) March 
		@elseif ($month == 4) April 
		@elseif ($month == 5) May 
		@elseif ($month == 6) June 
		@elseif ($month == 7) July 
		@elseif ($month == 8) August 
		@elseif ($month == 9) September 
		@elseif ($month == 10) October 
		@elseif ($month == 11) November 
		@elseif ($month == 12) December 
		@endif
		{{ $year }}
	</div>
	<div class="card-body">
		<table id="datatable" class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Title</th>
					<th>Category</th>
					<th>Views</th>
					<th>Author</th>
					<th>Create Date</th>
					<th>Publish Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($archives as $archive)
					<tr>
						<td><a href="{{ route('recipes.show', $archive->id) }}">{{ $archive->title }}</a></td>
						<td>{{ ucwords($archive->category->name) }}</td>
						<td>{{ $archive->views }}</td>
						<td>
							{{ $archive->user->profile->first_name }} {{ $archive->user->profile->last_name }}
							{{-- @include('common.authorFormat', ['model'=>$archive, 'field'=>'user']) --}}
						</td>
						<td>
							{{ $archive->created_at->format('M d, Y') }}
						</td>
						{{-- <td>@include('common.dateFormat', ['model'=>$archive, 'field'=>'created_at'])</td> --}}
						<td>
							{{ $archive->published_at->format('M d, Y') }}
							{{-- @include('common.dateFormat', ['model'=>$archive, 'field'=>'published_at']) --}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>