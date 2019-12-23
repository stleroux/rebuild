<div class="card mb-2">
	<div class="card-header p-2">Team 1 Scoresheet</div>

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
				$t1no = zeroOneTeamScores($game, 1)->count();
			@endphp
			@foreach(zeroOneTeamScores($game, 1) as $score)
				<tr class="text-light">
					<td>{{ $t1no }}</td>
					<td class="text-center">{{ $score->first_name }}</td>
					<td class="text-center">{{ $score->score }}</td>
					<td class="text-center">{{ $score->remaining }}</td>
				</tr>
				@php
					$t1no --;
				@endphp
			@endforeach
		</tbody>
	</table>
	
</div>
