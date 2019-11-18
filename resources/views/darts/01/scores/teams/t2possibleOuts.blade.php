<div class="card">
	<div class="card-header">
		<div class="card-title">Possible Outs</div>
	</div>
	<div class="card-body">
		@include('darts.inc.possibleOuts', ['score'=>($game->type - zeroOneTeamScores($game, 2)->sum('score'))])
	</div>
</div>