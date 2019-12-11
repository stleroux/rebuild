<div class="card mb-2">

	<div class="card-header p-2">Team 2</div>

	<div class="card-body p-2">
		
      {!! Form::open(['route' => 'darts.01.teams.store']) !!}
			{{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
			{{ Form::hidden('team_id', 2, ['size'=>3]) }}
			{{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
			{{ Form::hidden('remainingScore', ($game->type - zeroOneTeamScores($game, 2)->sum('score')), ['size'=>3]) }}
			
         @foreach(zeroOneTeamPlayers($game, 2) as $player)

            @if(!$teamGameDone)
               @if($player->shooting_order == $nextShot)
                  <label class="bg-secondary border btn-block p-2 m-0">
                     {{ Form::radio('user_id', $player->user_id , true) }}
                     {{ $player->first_name }} {{ $player->last_name }}
                  </label>
               @else
                  <label class="bg-primary btn-block p-2 m-0">
                     {{ Form::radio('user_id', $player->user_id , false, ['disabled']) }}
                     {{ $player->first_name }} {{ $player->last_name }}
                  </label>
               @endif
            @else
               <label class="bg-primary btn-block p-2 m-0">
                  {{ Form::radio('user_id', $player->user_id , false, ['disabled']) }}
                  {{ $player->first_name }} {{ $player->last_name }}
               </label>
            @endif

			@endforeach

			<div class="container pt-2">
            <div class="row justify-content-md-center">
               <div class="col-xs-12 col-sm-6">
               	@if(!$teamGameDone)
                     <input class="form-control form-control-lg mb-2" type="text" id="score" name="score2" {{ ($tID == 1) ? 'disabled' : 'autofocus' }} style="text-align: center" />
							<input class="btn btn-lg btn-primary col p-1 border" type="submit" name="t2submit" value="Submit" {{ ($tID == 1) ? 'disabled="disabled"' : '' }} />
               	@endif
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

<script type="text/javascript">
  $('#score').focus();
</script>
