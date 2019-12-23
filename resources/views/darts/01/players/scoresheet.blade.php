<div class="col-sm-4">
   <div class="card mb-2">
      <div class="card-header p-2">{{ $player->first_name }}</div>
      <div class="card-body p-2">
         <table class="table table-sm table-hover">
            <thead>
               <tr>
                  <th>No</th>
                  <th class="text-center">Score</th>
                  <th class="text-center">Remaining</th>
               </tr>
            </thead>
            <tbody>
               @php
                  $t1no = zeroOnePlayerScore($game->id, $player->user_id)->count();
               @endphp
               
               @foreach(zeroOnePlayerScore($game->id, $player->user_id) as $score)
                  <tr class="text-light">
                     <td>{{ $t1no }}</td>
                     <td class="text-center">{{ $score->score }}</td>
                     <td class="text-center">{{ $score->remaining }}</td>
                  </tr>
                  @php
                     $t1no --;
                  @endphp
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
