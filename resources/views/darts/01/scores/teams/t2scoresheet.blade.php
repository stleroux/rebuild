<div class="card mb-2">
	<div class="card-header p-2">Team 2 Scoresheet</div>

	<table class="table table-sm table-hover">
		<thead>
			<tr>
				<th>No</th>
				<th class="text-center">Player</th>
				<th class="text-center">Score</th>
				<th class="text-center">Remaining</th>
			</tr>
		</thead>
		<tbody>
			@php
				$t2no = zeroOneTeamScores($game, 2)->count();
			@endphp
			@foreach(zeroOneTeamScores($game, 2) as $score)
				<tr>
					<td>{{ $t2no }}</td>
					<td class="text-center">{{ $score->first_name }}</td>
					<td class="text-center">{{ $score->score }}</td>
					<td class="text-center">{{ $score->remaining }}</td>
				</tr>
				@php
					$t2no --;
				@endphp
			@endforeach
		</tbody>
	</table>

</div>
