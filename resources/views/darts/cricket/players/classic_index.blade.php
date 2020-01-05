@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('darts.blocks.sidebar')
@endsection

@section('content')

	<div class="card mb-2">
		<div class="card-header card_header p-2">
			CRICKET - PLAYER GAME
			<span class="float-right">Game ID : {{ $game->id }}</span>
		</div>
		<div class="card-body card_body p-2">
				<div class="col-7 mx-auto p-0">
					<table class="table table-sm table-bordered">
						<thead align="center">
							<tr class="h3">
								<th></th>
								<th class="w-25">
									{{-- {{ $players->get(0)->id }} --}}
									{{ $players->get(0)->first_name }}
								</th>
								<th></th>
								<th>Score</th>
								<th></th>
								<th class="w-25">
									{{-- {{ $players->get(1)->id }} --}}
									{{ $players->get(1)->first_name }}
								</th>
								<th></th>
							</tr>
						</thead>
						<tbody align="center" class="bg-secondary">
							@include('darts.cricket.players.inc.20')
							@include('darts.cricket.players.inc.19')
							@include('darts.cricket.players.inc.18')
							@include('darts.cricket.players.inc.17')
							@include('darts.cricket.players.inc.16')
							@include('darts.cricket.players.inc.15')
							@include('darts.cricket.players.inc.bull')
							@include('darts.cricket.players.inc.totals')
						</tbody>
					</table>
				</div>
				@if($game->status != 'Completed')
					<a href="{{ route('darts.cricket.players.completed', $game->id) }}" class="btn btn-sm btn-outline-info float-right">Mark Game As Completed</a>
				@endif
		</div>
		
		@include('darts.cricket.inc.footer')
	</div>

@endsection
