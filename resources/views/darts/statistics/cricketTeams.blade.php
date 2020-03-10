<div class="card">
   <div class="card-header card_header p-2">Cricket Team Stats</div>
   <table class="darts table table-sm table-hover">
      <thead>
         <tr>
            <th>Player Name</th>
            <th class="text-center">Played</th>
            <th class="text-center">Won</th>
            <th class="text-center">Lost</th>
            <th class="text-center">Win%</th>                           
            <th class="text-center">Best Score</th>
         </tr>
      </thead>
      <tbody>
         @foreach($players as $player)
            <tr class="text-light">
               <td>{{ $player->first_name }}</td>
               <td class="text-center">{{ cricketTeamGamesPlayedStat($player) }}</td>
               <td class="text-center"></td>
               <td class="text-center"></td>
               <td class="text-center"></td>
               <td class="text-center"></td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>
