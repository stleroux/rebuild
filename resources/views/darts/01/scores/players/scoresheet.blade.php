<div class="col-sm-6">
   <div class="card mb-2">
      <div class="card-header p-2">{{ $player->first_name }} [{{ $player->user_id }}]</div>
      <div class="card-body p-2">
         {{-- {{ $game->id }} <br /> --}}
         {{-- {{ $player->user_id }} --}}
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
                  // dd($t1no);
               @endphp
               
               @foreach(zeroOnePlayerScore($game->id, $player->user_id) as $score)
                  <tr>
                     <td>{{ $t1no }}</td>
                     <td class="text-center">{{ $score->score }}</td>
                     <td class="text-center">
                        {{ $score->remaining }}
                        {{-- {{ $game->type - zeroOnePlayerScore($game->id, $player->user_id)->sum('score') }} --}}
                     </td>
                  </tr>
                  @php
                     $t1no --;
                  @endphp
               @endforeach
            </tbody>
         </table>
      </div>
      {{-- <div class="panel-footer">
         Footer
      </div> --}}
   </div>
</div>