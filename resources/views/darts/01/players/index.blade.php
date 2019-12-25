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

   @if(!$gameDone)
      @include('darts.inc.scoreboard')
   @endif
   
   
   <div class="form-row">
      <div class="col-sm-4">
         @include('darts.01.players.scorePanel')
      </div>

      @isset($gameDone)
         @if(!$gameDone)
            <div class="col-sm-4">
               @include('darts.inc.dartboard')
            </div>

            <div class="col-sm-4">
               @include('darts.01.players.playerStats')
               @include('darts.01.players.gameInfo')
            </div>
         @else
            <div class="col-sm-4">
               @include('darts.01.players.gameInfo')
            </div>
            <div class="col-sm-4">
               @include('darts.01.players.playerStats')
            </div>
         @endif
      @endisset
   </div>

   <div class="form-row">
      <div class="col-sm-12">
         <div class="card-group">
            <div class="card mb-2">
               <div class="card-header p-2">Scoresheets</div>
               <div class="card-body p-2">
                  <div class="form-row">
                     @foreach($players as $player)
                        @include('darts.01.players.scoresheet', [$player])
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

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
@endsection
