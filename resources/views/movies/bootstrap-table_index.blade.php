<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Hello, Bootstrap Table!</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
	</head>
	<body>

@if($movies->count() > 0)
	<table
		data-toggle="table"
  		data-pagination="true"
		data-search="true"
		data-show-multi-sort="true" data-show-multi-sort-button="true"
		class="table table-hover table-sm">
		<thead>
			<tr>
				<th data-sortable="true" data-field="title">Title</th>
				<th data-sortable="true" data-field="col_no">ColNo</th>
				<th data-sortable="true" data-field="category">Genre</th>
				<th>Runtime</th>
				<th>Views</th>
				<th>IMDB</th>
				<th>Created</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($movies as $movie)
				<tr>
					<td><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
					<td>{{ $movie->col_no }}</td>
					<td>{{ $movie->category }}</td>
					<td>{{ $movie->running_time }}</td>
					<td>{{ $movie->views }}</td>
					<td>
						@if($movie->original_title)
							<a href="https://www.imdb.com/title/{{ $movie->original_title }}" target="_blank">{{ $movie->original_title }}</a>
						@endif
					</td>
					<td data-order="{{ $movie->created_at}}">{{ $movie->created_at }}</td>
					<td>
						<div class="float-right">
							<div class="btn-group">
								@include('movies.buttons.favorite', ['size'=>'xs'])
							</div>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{-- {{ $movies->links() }} --}}
@else
	{{ setting('no_records_found') }}
@endif

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/multiple-sort/bootstrap-table-multiple-sort.js"></script>
	</body>
</html>