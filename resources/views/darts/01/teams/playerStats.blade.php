<div class="card mb-2">

	<div class="card-header p-2">Players Statistics</div>

	<table class="table table-sm table-hover">
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
			@foreach(zeroOnePlayers($game->id) as $player)
				<tr class="text-center text-light">
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
