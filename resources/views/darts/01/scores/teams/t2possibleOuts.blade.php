<div class="card mb-2">

	<div class="card-header p-2">Possible Outs</div>

	<div class="card-body p-2">
		@include('darts.inc.possibleOuts', ['score'=>($game->type - zeroOneTeamScores($game, 2)->sum('score')), 'user'=>$user])
	</div>

</div>
