<div class="card mb-2">
   <div class="card-header p-2">Players</div>

   <div class="card-body p-2">
      {{-- <div class="row"> --}}
         {!! Form::open(['route' => 'darts.01.scores.players.store']) !!}
            {{-- Game ID : --}}
            {{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
            {{-- <br /> --}}
            {{-- {{ Form::text('team_id', 1, ['size'=>3]) }} --}}
            {{-- Game Type :  --}}
            {{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
            {{-- <br /> --}}
            {{-- {{ Form::text('nextShot', zeroOneNextShot($game->id), ['size'=>3]) }} --}}
            @php
               $nextShot = zeroOneNextShot($game->id);
               // dd($nextShot);
            @endphp
            {{-- Next Shot :  --}}
            {{-- {{ $nextShot }} --}}
            {{-- <br /> --}}

            
            {{-- <div class="col-xs-12 border"> --}}
               {{-- <div class="btn-group btn-group-vertical {{ $errors->has('user_id') ? 'has-error' : '' }}" data-toggle="buttons"> --}}
                  @foreach($players as $player)
                  {{-- <hr /> --}}
                  {{-- USER ID : {{ $user->user_id }} --}}
                  {{-- <br /> --}}
                     {{-- Remaining Score : --}}
                     {{ Form::hidden('remainingScore', ($game->type - zeroOnePlayerScore($game->id, $player->user_id)->sum('score')), ['size'=>2]) }}
                     {{-- <br /> --}}
                     {{-- Shooting Order : {{ $user->shooting_order }} --}}
                     {{-- <br /> --}}
                     {{-- {{ zeroOneNextShot($game->id) }} --}}
                     {{-- <br /> --}}
                     {{-- Next Shot: {{zeroOneNextShot($game->id)}} --}}
                     <label class="col p-2 m-0 btn btn-primary {{ ($player->shooting_order == $nextShot) ? 'active':'' }}">
                        {{-- {{ dd($user->shooting_order) }} --}}
                        {{-- {{ dd(zeroOneNextShot($game)) }} --}}
                        {{-- {{ $user->shooting_order }} / {{ zeroOneNextShot($game) }} --}}
                         {{-- {{ zeroOneNextShot($game) }} / {{ $user->shooting_order }} --}}
                        {{-- @if($user->shooting_order == zeroOneNextShot($game->id)) --}}
                        {{-- @if(zeroOneNextShot($game) == $user->shooting_order) --}}
                           {{ Form::radio('user_id', $player->user_id , ($player->shooting_order == $nextShot) ?? true) }}
                           {{-- {{ Form::radio('user_id', $player->user_id , ($player->shooting_order == $nextShot) ?? true) }} --}}
                        {{-- @endif --}}
                           {{-- {{ Form::radio('user_id', $user->user_id , false) }} --}}

                        {{ $player->first_name }} {{ $player->last_name }}
                     </label>
                  @endforeach
               {{-- </div> --}}
            {{-- </div> --}}
            
            <div class="container pt-2">
               <div class="row justify-content-md-center">
                  <div class="col-xs-12 col-sm-6">
                     @if($game->type - zeroOnePlayerScore($game->id, $player->user_id)->sum('score') <= 0)
                        <input class="form-control form-control-lg" type="text" name="score" style="text-align: center" disabled>
                        <input class="btn btn-block btn-lg btn-danger" type="submit" name="submit" value="Submit" disabled />
                     @else
                        {{-- <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}" > --}}
                           <input class="form-control form-control-lg" type="text" name="score" style="text-align: center" autofocus />
                           <input class="btn btn-block btn-lg btn-secondary" type="submit" name="submit" value="Submit" />
                        {{-- </div> --}}
                     @endif
                  </div>
               </div>
            </div>
         {{ Form::close() }}
      {{-- </div> --}}
   </div>
   <div class="card-footer p-1">
      Select a player, enter the score and click Submit
   </div>
</div>
