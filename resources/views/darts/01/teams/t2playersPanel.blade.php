<div class="card mb-2">

	<div class="card-header p-2">Team 2 Players</div>

	<div class="card-body p-2">
		
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

	</div>
	
</div>
