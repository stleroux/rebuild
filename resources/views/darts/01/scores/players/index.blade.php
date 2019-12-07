@extends ('layouts.master')

@section('stylesheets')
   <style>
      .hover { background-color: grey; }
      .thead tr th { color: yellow; }

      /*tr.rowcolSelected{ background-color: #222222; }*/
      td.rowcolSelected:hover{
         background-color: red;
         color: black;
         font-weight: bold;
      }
   </style>
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')
{{-- {{ $user }} --}}
   @if(!$gameDone)
      @include('darts.inc.scoreboard')
   @endif
   
   <div class="col-xs-12">
      <div class="card mb-2">
         <div class="card-header p-2">
            Single Player Game
            <span class="float-right">Game Type : {{ $game->type }}</span>
         </div>
      </div>
   </div>   
   
   <div class="form-row">
      <div class="col-sm-4">
         {{-- @include('darts.01.scores.players.scorePanel', ['user'=>$user]) --}}
         @include('darts.01.scores.players.scorePanel')
      </div>

      <div class="col-sm-4">
         @include('darts.01.scores.players.gameInfo')
      </div>

      <div class="col-sm-4">
         @include('darts.01.scores.players.playerStats')
      </div>
   </div>

   <div class="form-row">
      <div class="col-sm-12">
         <div class="card-group">
            <div class="card mb-2">
               <div class="card-header p-2">Scoresheets</div>
               <div class="card-body p-2">
                  <div class="form-row">
                     @foreach($players as $player)
                        @include('darts.01.scores.players.scoresheet', [$player])
                     @endforeach
                  </div>
               </div>
               {{-- <div class="card-footer p-1">
                  Footer
               </div> --}}
            </div>
         </div>
      </div>
   </div>

{{--    <div class="form-row">
      <div class="col-sm-12 col-md-4">
         <div class="card-group">
            <div class="card mb-1">
               <div class="card-header p-2">Possible Outs</div>
               <div class="card-body p-1">
                  @include('darts.inc.possibleOuts', ['score' => $remainingScore])
               </div>
            </div>
         </div>
      </div>
   </div> --}}

@endsection

@section('scripts')
   <script>
      $("#tbl").delegate('td','mouseover mouseleave', function(e) {
         if (e.type == 'mouseover') {
            $(this).parent().addClass("hover");
            $("colgroup").eq($(this).index()).addClass("hover");
         } else {
            $(this).parent().removeClass("hover");
            $("colgroup").eq($(this).index()).removeClass("hover");
         }
      });
   </script>

   <script type="text/javascript">
      // $(document).ready(function () {
      //    window.setTimeout(function() {
      //       $(".alert").fadeTo(1500, 0).slideUp(1500, function(){
      //          $(this).remove(); 
      //       });
      //    }, 7000);
      // });


      $(document).ready(function(){
         $('#display-dart-success').fadeIn().delay(4000).fadeOut();
         $('#display-dart-error').fadeIn().delay(8000).fadeOut();
         $('#display-dart-danger').fadeIn().delay(8000).fadeOut();
      });

   </script>
@endsection