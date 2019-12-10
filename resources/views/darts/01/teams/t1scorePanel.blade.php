{{-- 	@if($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0 )
		<div class="card mb-2">
	@elseif($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0 )
		<div class="card mb-2">
	@else
		<div class="card mb-2 {{ zeroOneTeamScores($game, 1)->count() <= zeroOneTeamScores($game, 2)->count() ? 'warning' : 'primary' }}">
	@endif --}}
	<div class="card mb-2">
	<div class="card-header p-2">Team 1</div>
	<div class="card-body p-2">
		{{-- <div class="row"> --}}
			{!! Form::open(['route' => 'darts.01.teams.store']) !!}
				{{-- Game ID :  --}}
				{{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
				{{-- <br /> --}}
				{{-- Team ID :  --}}
				{{ Form::hidden('team_id', 1, ['size'=>3]) }}
				{{-- {{ $tID }} --}}
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
{{-- 							<label class="btn btn-md btn-primary btn-block p-2 m-0 {{ ($player->shooting_order == $nextShot) ? 'btn-secondary':'' }}">
								@if($player->shooting_order == $nextShot)
									{{ Form::radio('user_id', $player->user_id , true) }}
								@else
									{{ Form::radio('user_id', $player->user_id , false) }}
								@endif
								{{ $player->first_name }} {{ $player->last_name }}
							</label> --}}
							@if($player->shooting_order == $nextShot)
							   <label class="btn btn-md btn-primary btn-block p-2 m-0 btn-secondary">
							{{-- {{ Form::radio('user_id', $player->user_id , ($player->shooting_order == $nextShot) ?? true) }} --}}
							      {{ Form::radio('user_id', $player->user_id , true) }}
							      {{ $player->first_name }} {{ $player->last_name }}
							   </label>
							@else
							   <label class="btn btn-md btn-primary btn-block p-2 m-0 btn-primary disabled">
							      {{ Form::radio('user_id', $player->user_id , false, ['disabled']) }}
							      {{ $player->first_name }} {{ $player->last_name }}
							   </label>
							@endif
						@endforeach
					{{-- </div> --}}
				{{-- </div> --}}
				{{-- <div class="col text-center"> --}}
					<div class="container pt-2">
	               <div class="row justify-content-md-center">
	                  <div class="col-xs-12 col-sm-6">
								@if(!$teamGameDone)
									<div class="form-group p-0 {{ $errors->has('score2') ? 'has-error' : '' }}" >
										@if($nextShot % 2 == 0)
											<input class="form-control form-control-lg p-0" type="text" name="score1" style="text-align: center" />
										@else
											<input class="form-control form-control-lg p-0" type="text" id ="score" name="score1" style="text-align: center" autofocus />
										@endif
									</div>
									<input class="btn btn-lg btn-primary col p-1 border" type="submit" name="t2submit" value="Submit" />
								@endif

								{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0))
									<input class="form-control input-lg p-1 mb-2" type="text" name="score2" style="text-align: center" disabled>
									<input class="btn btn-lg btn-primary col p-1 mb-0" type="submit" value="Submit" disabled />
								@else
									<div class="form-group {{ $errors->has('score2') ? 'has-error' : '' }}" >
										@if($nextShot % 2 == 0)
											<input class="form-control input-lg p-1 mb-0 border" type="text" name="score1" style="text-align: center" />
										@else
											<input class="form-control input-lg p-1 mb-0 border" type="text" id ="score" name="score1" style="text-align: center" autofocus />
										@endif
									</div>
									<input class="btn btn-lg btn-primary col p-1 mb-0 border" type="submit" name="t2submit" value="Submit" />
								@endif --}}
							</div>
						</div>
					</div>
			{{ Form::close() }}
		</div>
	
	@if(!$teamGameDone)
		<div class="card-footer p-1">
			Select a player, enter the score and click Submit
		</div>
	@endif
</div>

{{-- <script type="text/javascript">
  $('#score').focus();
</script> --}}
