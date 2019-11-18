<div class="card">
	<div class="card-header">
		<div class="card-title">Players Statistics</div>
	</div>
	<div class="card-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Team</th>
					<th>Player</th>
					<th class="text-center">Best Score</th>
					<th class="text-center">Score Avg</th>
					<th class="text-center">Dart Avg</th>
				</tr>
			</thead>
			<tbody>
				@foreach(zeroOnePlayers($game) as $player)
					<tr class="text-center">
						<td>{{ $player->team_id }}</td>
						<td class="text-left">{{ $player->first_name }}</td>
						<td>{{ zeroOnePlayerBestScore($player) }}</td>
						<td>{{ zeroOnePlayerScoreAvg($player) }}</td>
						<td>{{ zeroOnePlayerDartAvg($player) }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{{-- <div class="card-footer">
		Footer
	</div> --}}
</div>
