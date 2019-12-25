
{!! Form::open(['route' => 'darts.01.players.store']) !!}
   {{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
   {{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
   <input type="hidden" name="remainingScore" value="{{ $remainingScore }}" />

   <div class="card mb-2">
   
      <div class="card-header p-2">
         @if(!$gameDone)
            Enter Selected Player's Score
         @else
            Players
         @endif
      </div>

      <div class="card-body p-2">

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

         @if(!$gameDone)
            <div class="container pt-2">
               <div class="row justify-content-center">
                  <div class="input-group col-sm-6">
                     <input class="form-control form-control-lg" type="text" id="score" name="score" autocomplete="off" style="text-align: center" />
                     <div class="input-group-append">
                        <button class="btn btn-success btn-lg" type="submit">Go!</button>
                     </div>
                  </div>
               </div>
            </div>
         @endif

      </div>

      @if(!$gameDone)
         <div class="card-footer p-1">
            @if ($message = Session::get('dart-success'))
               <div class="text-light" id="display-dart-success">
                  {{ Session('dart-success') }}
               </div>
               <div class="p-0" id="display-dart-empty">
                  Click Go! or Press Enter to submit
               </div>

            @elseif ($message = Session::get('dart-error'))
               <div class="text-light" id="display-dart-error">
                  {{ Session('dart-error') }}
               </div>
               <div class="p-0" id="success-empty">
                  Click Go! or Press Enter to submit
               </div>

            @elseif(count($errors) > 0)
               @foreach ($errors->all() as $error)
                  <div class="text-danger" id="display-dart-error">
                     {{ $error }}
                  </div>
                  <div class="p-0" id="success-empty">
                     Click Go! or Press Enter to submit
                  </div>
               @endforeach

            @else
               <div class="p-0">
                  Click Go! or Press Enter to submit
               </div>
            @endif
         </div>
      @endif
   </div>


{{ Form::close() }}

@section('scripts')
   <script type="text/javascript">
      $('#display-dart-empty').hide();
      setTimeout(function() {
         $('#display-dart-success').remove();
         $('#display-dart-error').remove();
         $('#display-dart-empty').show();
      }, 5000); // <-- time in milliseconds
   </script>

   <script type="text/javascript">
      $(document).ready(function(){
         $("#score").focus();
      });
   </script>
@endsection