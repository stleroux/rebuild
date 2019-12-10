<div class="card mb-2">
   
   <div class="card-header p-2">Players</div>

   <div class="card-body p-2">
      {!! Form::open(['route' => 'darts.01.players.store']) !!}
         {{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
         {{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
         <input type="hidden" name="remainingScore" value="{{ $remainingScore }}" />

         @foreach($players as $player)

            @if(!$gameDone)
               @if($player->shooting_order == $nextShot)
                  <label class="bg-secondary border btn-block p-2 m-0">
                     {{ Form::radio('user_id', $player->user_id , true) }}
                     {{ $player->first_name }} {{ $player->last_name }}
                  </label>
               @else
                  <label class="bg-primary btn-block p-2 m-0">
                     {{ Form::radio('user_id', $player->user_id , false, ['disabled']) }}
                     {{ $player->first_name }} {{ $player->last_name }}
                  </label>
               @endif
            @else
               <label class="bg-primary btn-block p-2 m-0">
                  {{ Form::radio('user_id', $player->user_id , false, ['disabled']) }}
                  {{ $player->first_name }} {{ $player->last_name }}
               </label>
            @endif

         @endforeach

         <div class="container pt-2">
            <div class="row justify-content-md-center">
               <div class="col-xs-12 col-sm-6">
                  @if(!$gameDone)
                     <div class="form-group p-0 {{ $errors->has('score2') ? 'has-error' : '' }}" >
                        <input class="form-control form-control-lg p-0" type="text" id="score" name="score" style="text-align: center" autofocus />
                     </div>
                     <input class="btn btn-lg btn-primaryary col p-1 border" type="submit" name="submit" value="Submit" />
                  @endif
               </div>
            </div>
         </div>
      {{ Form::close() }}
   </div>

   @if(!$gameDone)
      <div class="card-footer p-1">
         Select a player, enter the score and click Submit
      </div>
   @endif

</div>
