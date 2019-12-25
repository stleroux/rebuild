<div class="card mb-2">
   <div class="card-header p-2">
      Game Info
      <div class="float-right">
         N<sup>o</sup> : {{ $game->id }}
      </div>
   </div>
   <div class="card-body p-2">
      <div class="form-row">
         <div class="col-4">
            <div class="card mb-2">
               <div class="card-header text-center p-2">Type</div>
               <div class="card-body text-center p-2">
                  {{ $game->type }}
               </div>
            </div>
         </div>
      
         @if($gameDone)
            <div class="col">
               <div class="card mb-2 border border-success">
                  <div class="card-header text-center p-2 bg-success text-dark">Winner</div>
                  <div class="card-body text-center p-2">
                     @foreach($players as $player)
                        @if($game->type - zeroOnePlayerScore($game->id, $player->user_id)->sum('score') == 0)
                           {{ $player->first_name }}
                        @endif
                     @endforeach
                  </div>
               </div>
            </div>
         @endif
      </div>
   </div>
</div>
