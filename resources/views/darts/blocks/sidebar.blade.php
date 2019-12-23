<div class="card mb-3 p-0 m-0">

   <div class="card-header block_header p-2 m-0">Darts Menu</div>

   <div class="list-group">

      <a href="{{ route('darts.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('darts.index') ? 'active' : '' }}">
         <i class="fa fa-bullseye"></i>
         Leader Board
      </a>

      @if(checkPerm('dart_add'))
         <a href="{{ route('darts.game.create') }}"
            class="list-group-item list-group-item-action p-1
            {{ Route::is('darts.games.create') ? 'active' : '' }}
            {{ Route::is('darts.games.selectTeamsOrPlayers') ? 'active' : '' }}
            {{ Route::is('darts.games.selectPlayers') ? 'active' : '' }}
         ">
            <i class="fa fa-gamepad"></i>
            New Game
         </a>
      @endif

      @if(checkPerm('dart_browse'))
         <a href="{{ route('darts.games.board') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('darts.games.board') ? 'active' : '' }}">
            <i class="fa fa-industry"></i>
            Games Board
         </a>
      @endif

   </div>
</div>

@isset($gameDone)
   @if(!$gameDone)
      @include('darts.inc.possibleOuts', ['score'=>$remainingScore, 'user'=>$user])
   @endif
@endisset

{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') != 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') != 0)) --}}
{{-- @if($game->type - zeroOneTeamScores($game, $teamID)->sum('score') != 0) --}}
   {{-- @include('darts.01.scores.teams.t'.$player->team_id.'1possibleOuts') --}}
   {{-- @include('darts.01.scores.teams.possibleOuts', ['teamID'=>$teamID]) --}}
   {{-- @include('darts.inc.possibleOuts', ['score' => $remainingScore]) --}}
{{-- @endif --}}

{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0)) --}}
{{-- @isset($teamGameDone)
   @if(!$teamGameDone) --}}
{{-- @isset($teamGameDone) --}}
      {{-- @if($teamGameDone) --}}
      {{-- @include('darts.01.scores.teams.t1possibleOuts', ['user'=>$user]) --}}
{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') == 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') == 0))
      @include('darts.inc.possibleOuts', ['score'=>$remainingScore, 'user'=>$user]) --}}
   {{-- @else
      @include('darts.01.scores.teams.t2possibleOuts') --}}
   {{-- @endif --}}
{{-- @endif --}}


{{-- TeamGameOver : {{$teamGameDone}} --}}
@isset($teamGameDone)
   @if(!$teamGameDone)
      {{-- @include('darts.01.scores.teams.t1possibleOuts', ['user'=>$user]) --}}
      @include('darts.inc.possibleOuts', ['score'=>$remainingScore, 'user'=>$user])
   @endif
@endisset

