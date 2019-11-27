	@if($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0 )
		<div class="card mb-2">
	@elseif($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0 )
		<div class="card mb-2">
	@else
		<div class="card mb-2 {{ zeroOneTeamScores($game, 1)->count() <= zeroOneTeamScores($game, 2)->count() ? 'warning' : 'primary' }}">
	@endif
	<div class="card-header p-2">Team 1</div>
	<div class="card-body p-2">
		{{-- <div class="row"> --}}
			{!! Form::open(['route' => 'darts.01.scores.teams.store']) !!}
				{{-- Game ID :  --}}
				{{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
				{{-- <br /> --}}
				{{-- Team ID :  --}}
				{{ Form::hidden('team_id', 1, ['size'=>3]) }}
				{{-- <br /> --}}
				{{-- Remaining Score :  --}}
				{{ Form::hidden('remainingScore', ($game->type - zeroOneTeamScores($game, 1)->sum('score')), ['size'=>3]) }}
				{{-- <br /> --}}
				{{-- Game Type : --}}
				{{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
				{{-- <br /> --}}
				@php
               $nextShot = zeroOneNextShot($game->id);
               // dd($nextShot);
            @endphp
            {{-- Next Shot :  --}}
            {{-- {{ $nextShot }} --}}
            {{-- <br /> --}}
				{{-- <div class="col border"> --}}
					{{-- <div class="btn-group btn-group-vertical {{ $errors->has('user_id') ? 'has-error' : '' }}" data-toggle="buttons"> --}}
						@foreach(zeroOneTeamPlayers($game, 1) as $player)
						{{-- @foreach($players as $player) --}}
							{{-- {{ $user->shooting_order }}
							{!! nextShot($game) !!} --}}
							<label class="btn btn-md btn-primary btn-block {{ ($player->shooting_order == $nextShot) ? 'active':'' }} p-2 mb-0">
								{{-- <label class="col p-2 m-0 btn btn-primary {{ ($player->shooting_order == $nextShot) ? 'active':'' }}"> --}}
								@if($player->shooting_order == $nextShot)
									{{ Form::radio('user_id', $player->user_id , true) }}
								@else
									{{ Form::radio('user_id', $player->user_id , false) }}
								@endif
								{{ $player->first_name }} {{ $player->last_name }}
								{{-- [{{ $player->shooting_order }}] --}}
							</label>
						@endforeach
					{{-- </div> --}}
				{{-- </div> --}}
				{{-- <div class="col text-center"> --}}
					<div class="container pt-2">
	               <div class="row justify-content-md-center">
	                  <div class="col-xs-12 col-sm-6">
								@if(($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0))
									<input class="form-control input-lg p-1 mb-2" type="text" name="score2" style="text-align: center" disabled>
									<input class="btn btn-lg btn-primary col p-1 mb-0" type="submit" value="Submit" disabled />
								@else
									<div class="form-group {{ $errors->has('score2') ? 'has-error' : '' }}" >
										{{-- {{ dd(zeroOneNextShot($game) % 2 == 0) }} --}}
										{{-- @if(zeroOneNextShot($game) % 2 == 0) --}}
										@if($nextShot % 2 == 0)
											<input class="form-control input-lg p-1 mb-0 border" type="text" name="score1" style="text-align: center" />aaa
										@else
											<input class="form-control input-lg p-1 mb-0 border" type="text" name="score1" style="text-align: center" autofocus />
										@endif
									</div>
									<input class="btn btn-lg btn-primary col p-1 mb-0 border" type="submit" name="t2submit" value="Submit" />
								@endif
							</div>
						</div>
					</div>
			{{ Form::close() }}
		</div>
	{{-- </div> --}}
	<div class="card-footer p-1">
		Select a player, enter the score and click Submit
	</div>
</div>