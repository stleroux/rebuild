<div class="card mb-2">
   
   <div class="card-header p-2">Players</div>

   <div class="card-body p-2">
      {!! Form::open(['route' => 'darts.01.scores.players.store']) !!}
         {{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
         {{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
         <input type="hidden" name="remainingScore" value="{{ $remainingScore }}" />

         @foreach($players as $player)
            <label class="col p-2 m-0 btn btn-primary {{ ($player->shooting_order == $nextShot) ? 'btn-secondary':'' }}">
               {{ Form::radio('user_id', $player->user_id , ($player->shooting_order == $nextShot) ?? true) }}
               {{ $player->first_name }} {{ $player->last_name }}
            </label>
         @endforeach
         
         <div class="container pt-2">
            <div class="row justify-content-md-center">
               <div class="col-xs-12 col-sm-6">
                  @if($gameDone)
                     <input class="form-control form-control-lg" type="text" name="score" style="text-align: center" disabled>
                     <input class="btn btn-block btn-lg btn-secondary" type="submit" name="submit" value="Submit" disabled />
                  @else
                     <input class="form-control form-control-lg" type="text" name="score" style="text-align: center" autofocus />
                     <input class="btn btn-block btn-lg btn-primaryary" type="submit" name="submit" value="Submit" />
                  @endif
               </div>
            </div>
         </div>
      {{ Form::close() }}
   </div>

   <div class="card-footer p-1">
      Select a player, enter the score and click Submit
   </div>

</div>
