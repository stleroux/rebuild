{{-- <div class="card-group"> --}}
	<div class="card mb-2">
		<div class="card-header p-2">
			Game Info
		</div>
		<div class="card-body p-0 m-0">
			<div class="row p-1 m-0">
				<div class="col-sm-4 p-0">
					<div class="card mb-2">
						<div class="card-header p-2 text-center" style="padding-bottom: 0px; padding-top:0px">
							Remains
						</div>
						<div class="card-body text-center" style="background-color:{{ ($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0 )?"green":"" }} ">
							{{ $game->type - zeroOneTeamScores($game, 1)->sum('score') }}
						</div>
					</div>
				</div>

				<div class="col-sm-4 p-0">
					<div class="card mb-2">
						<div class="card-header p-2 text-center">
							Type
						</div>
						<div class="card-body text-center">
							{{ $game->type }}
						</div>
					</div>
				</div>

				<div class="col-sm-4 p-0">
					<div class="card mb-2">
						<div class="card-header p-2 text-center" style="padding-bottom: 0px; padding-top:0px">
							Remains
						</div>
						<div class="card-body text-center" style="background-color:{{ ($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0 )?"green":"" }} ">
							{{ $game->type - zeroOneTeamScores($game, 2)->sum('score') }}
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