<div class="card mb-2">
   <div class="card-header card_header p-2">01 Individual Stats</div>
   <div class="card-body p-0 m-0">
   <table class="darts table table-sm table-hover">
      <thead>
         <tr>
            <th>Player Name</th>
            <th class="text-center">Played</th>
            <th class="text-center">Won</th>
            <th class="text-center">Lost</th>
            <th class="text-center">Practice</th>
            <th class="text-center">Win%</th>                           
            <th class="text-center">Best Score</th>
         </tr>
      </thead>
      <tbody>
         @foreach($players as $player)
            <tr class="text-light">
               <td>{{ $player->first_name }}</td>
               <td class="text-center">{{ zeroOnePlayerIndividualGamesPlayedStat($player) }}</td>
               <td class="text-center">{{ zeroOnePlayerIndividualGamesWonStat($player) }}</td>
               <td class="text-center">{{ zeroOnePlayerIndividualGamesLostStat($player) }}</td>
               <td class="text-center">{{ zeroOnePlayerIndividualPracticeStat($player) }}</td>
               <td class="text-center">{{ zeroOnePlayerIndividualGamesWinPercentageStat($player) }}</td>
               <td class="text-center">{{ zeroOnePlayerBestScoreIndividualStat($player) }}</td>
            </tr>
         @endforeach
      </tbody>
   </table>
   </div>
</div>
