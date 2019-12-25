{{-- Game ID :  --}}
{{ Form::hidden('game_id', $game->id, ['size'=>3]) }}
{{-- <br /> --}}
{{-- Team ID :  --}}
{{ Form::hidden('team_id', $tID, ['size'=>3]) }}
{{-- <br /> --}}
{{-- Game Type :  --}}
{{ Form::hidden('game_type', $game->type, ['size'=>3]) }}
{{-- <br /> --}}
{{-- Remaining Score :  --}}
{{ Form::hidden('remainingScore', ($game->type - zeroOneTeamScores($game, $tID)->sum('score')), ['size'=>3]) }}

@if(!$teamGameDone)
   <div class="card mb-2">
      <div class="card-header p-2">
         Enter Selected Player's Score
      </div>
      <div class="card-body p-2">
         <div class="row justify-content-center">
            <div class="input-group col-sm-6">
               <input class="form-control form-control-lg" type="text" id="score" name="score" autocomplete="off" style="text-align: center" />
               <div class="input-group-append">
                  <button class="btn btn-success btn-lg" type="submit">Go!</button>
               </div>
            </div>
         </div>
      </div>

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
   </div>
@endif

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