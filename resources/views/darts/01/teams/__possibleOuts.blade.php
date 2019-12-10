<div class="card mb-1">

   <div class="card-header p-2">Possible Outs</div>
   
   <div class="card-body p-1">
      {{-- @include('darts.inc.possibleOuts', ['score'=>($game->type - zeroOneTeamScores($game, 1)->sum('score'))]) --}}
      @include('darts.inc.possibleOuts', ['score'=>($game->type - zeroOneTeamScores($game, $teamID)->sum('score'))])
   </div>

</div>
