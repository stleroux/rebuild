<div class="card mb-2">
	<div class="card-header p-2">
		Game Info
		<div class="float-right">
      	N<sup>o</sup> : {{ $game->id }}
   	</div>
	</div>
	<div class="card-body p-2">
		<div class="form-row">
			<div class="col-4">
				<div class="card mb-2">
					<div class="card-header text-center p-2">Team 1</div>
					<div class="card-body text-center p-2" style="background-color:{{ ($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0 )?"green":"" }} ">
						{{ $game->type - zeroOneTeamScores($game, 1)->sum('score') }}
					</div>
					<div class="card-footer p-1 text-center">
						<small>Score Remaining</small>
					</div>
				</div>
			</div>

			<div class="col-4">
				<div class="card mb-2">
					<div class="card-header text-center p-2">Type</div>
					<div class="card-body text-center p-2">{{ $game->type }}</div>
				</div>
			</div>

			<div class="col-4">
				<div class="card mb-2">
					<div class="card-header text-center p-2">Team 2</div>
					<div class="card-body text-center p-2" style="background-color:{{ ($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0 )?"green":"" }} ">
						{{ $game->type - zeroOneTeamScores($game, 2)->sum('score') }}
					</div>
					<div class="card-footer p-1 text-center">
						<small>Score Remaining</small>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="panel-footer">
		<div class="row">
			<div class="col-xs-6">Next to shoot : {{ nextShot($game) }}</div>
			<div class="col-xs-6">Last to shoot : {{ lastShot($game) }}</div>
		</div>
	</div> --}}
</div>

@include('darts.01.scores.teams.messages')

	
{{-- </div> --}}