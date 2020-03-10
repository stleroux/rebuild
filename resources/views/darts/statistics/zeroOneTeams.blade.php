<div class="card">
   <div class="card-header card_header p-2">01 Team Stats</div>
   <table class="darts table table-sm table-hover">
      <thead>
         <tr>
            <th>Player Name</th>
            <th class="text-center">Played</th>
            <th class="text-center">Won</th>
            <th class="text-center">Lost</th>
            <th class="text-center">Closed</th>
            <th class="text-center">Best Score</th>
         </tr>
      </thead>
      <tbody>
         @foreach($players as $player)
            <tr class="text-light">
               <td>{{ $player->first_name }}</td>
               <td class="text-center">{{ zeroOneTeamGamesPlayedStat($player) }}</td>
               <td class="text-center">{{-- {{ zeroOneTeamGamesWonStat($player) }} --}}</td>
               <td class="text-center">{{-- {{ zeroOneTeamGamesLostStat($player) }} --}}</td>
               <td class="text-center">{{ zeroOneTeamGamesClosedStat($player) }}</td>
               <td class="text-center">{{ zeroOneTeamBestScoreStat($player) }}</td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>
