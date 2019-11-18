<div class="card mb-2">
   <div class="card-header p-2">Game Info</div>
   <div class="card-body p-2">
      <div class="form-row">
         <div class="col">
            <div class="card mb-2">
               <div class="card-header text-center p-2">Type</div>
               <div class="card-body text-center p-2">
                  {{ $game->type }}
               </div>
            </div>
         </div>
      
         <div class="col">
            <div class="card mb-2">
               <div class="card-header text-center p-2">Game ID</div>
               <div class="card-body text-center p-2">
                  {{ $game->id }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('darts.01.scores.players.messages')