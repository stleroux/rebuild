<div class="card mb-2">
   <div class="card-header p-2">Players Statistics</div>

   <div class="card-body p-2">
      <table class="table table-sm table-hover">
         <thead>
            <tr>
               <th>Player</th>
               <th>Remaining</th>
               <th class="text-center">Best Score</th>
               <th class="text-center">Score Avg</th>
               <th class="text-center">Dart Avg</th>
            </tr>
         </thead>
         <tbody>
            {{-- @foreach(zeroOnePlayers($game->id) as $player) --}}
            @foreach($players as $player)
               <tr class="text-center">
                  <td class="text-left">{{ $player->first_name }}</td>
                  <td>Remaining</td>
                  <td>{{ zeroOnePlayerBestScore($player) }}</td>
                  <td>{{ zeroOnePlayerScoreAvg($player) }}</td>
                  <td>{{ zeroOnePlayerDartAvg($player) }}</td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   {{-- <div class="panel-footer">
      Footer
   </div> --}}
</div>
