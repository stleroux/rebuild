@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

   <div class="card mb-2">

      <div class="card-header card_header p-2">
         CRICKET - @if($players->count() > 1) MULTI @else INDIVIDUAL @endif PLAYER GAME
         <span class="float-right">Game ID : {{ $game->id }}</span>
      </div>
      
      <div class="card-body card_body p-2">
         <table class="table table-sm">
            <thead align="center">
               <tr class="h3">
                  <th class="h1 bg-dark">Player</th>
                  @foreach($possibleScores as $pScore)
                     <th class="h1 bg-dark">
                        @if($loop->last)
                           Bull
                        @else
                           {{ $pScore }}
                        @endif
                     </th>
                  @endforeach
                  <th class="h1 bg-dark">Total</th>
               </tr>
            </thead>
            <tbody align="center">

               @foreach($players as $p)
                  <tr class="text-light">
                     <td class="h2 align-middle">{{ $players->get($loop->index)->first_name }}</td>

                     @foreach($possibleScores as $pScore)
                        <td class="p-0">
                           <table width="100%" class="table table-bordered p-0 m-0">
                              <tr class="">
                                 <td class="">
                                    {!! Form::open(['route'=>'darts.cricket.players.store']) !!}
                                       <input type="hidden" name="user_id" value="{{ $players->get($loop->parent->index)->id }}">
                                       <input type="hidden" name="game_id" value="{{ $game->id }}">
                                       <button type="submit" name="score" value="{{ $pScore }}" class="btn btn-sm btn-block btn-success" {{ ($game->status == 'Completed') ? 'disabled' : '' }}>
                                          <i class="far fa-arrow-alt-circle-up"></i>
                                       </button>
                                    {{ Form::close() }}
                                 </td>
                                 <td class="">
                                    {!! Form::open(['route'=>'darts.cricket.players.store']) !!}
                                       <input type="hidden" name="user_id" value="{{ $players->get($loop->parent->index)->id }}">
                                       <input type="hidden" name="game_id" value="{{ $game->id }}">
                                       <button type="submit" name="score" value="-{{ $pScore }}" class="btn btn-sm btn-block btn-danger" {{ ($game->status == 'Completed') ? 'disabled' : '' }}>
                                          <i class="far fa-arrow-alt-circle-down "></i>
                                       </button>
                                    {{ Form::close() }}
                                 </td>
                              </tr>
                              <tr class="">
                                 <td colspan="2" class="text-center p-1">
                                    @php
                                       // dd('Player ID : ' . $players->get($loop->parent->index)->id);
                                       // dd('Score : ' . $pScore);
                                       // dd('Game ID : ' . $game->id);

                                       $positiveCount = DB::table('dart__scores')->where('user_id', $players->get($loop->parent->index)->id)->where('score',$pScore)->where('game_id',$game->id)->count(); 
                                       // dd('Positive count : ' .$positiveCount);
                                                // -
                                       $negativeCount = DB::table('dart__scores')->where('user_id', $players->get($loop->parent->index)->id)->where('score',-$pScore)->where('game_id',$game->id)->count();
                                       // dd('Negative Count : ' . $negativeCount);
                                       
                                       $count = $positiveCount - $negativeCount;
                                       // dd('Total Count : ' . $count);

                                       // if($count > 3) {
                                          $points = ($count * $pScore) - ($pScore * 3);
                                       //    dd($points);
                                       // }

                                       // if($count < 1) {
                                       //    echo '<h2 class="pt-1 pb-0"><i class=""></i>NA</h2>';
                                       // }

                                       if($count == 1) {
                                          echo '<h2 class="pt-1 pb-0"><i class="fas fa-minus-circle"></i></h2>';
                                       }
                                       elseif($count == 2) {
                                          echo '<h2 class="pt-1 pb-0"><i class="fas fa-plus-circle"></i></h2>';
                                       }
                                       elseif($count == 3) {
                                          echo '<h2 class="pt-1 pb-0"><i class="fas fa-times-circle"></i></h2>';
                                       }
                                       elseif($count >= 4) {
                                          echo '<h2 class="pt-1 pb-0">' . $points .'</h2>';
                                       } else {
                                          echo "<h2 class='pt-1 pb-0'>&nbsp;</h2>";
                                       }
                                    @endphp
                                 </td>
                              </tr>
                           </table>
                        </td>
                     @endforeach
                     <td class="h2 align-middle">
                        @php
                           $positiveFifteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',15)->where('game_id',$game->id)->sum('score');
                           $negativeFifteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-15)->where('game_id',$game->id)->sum('score');
                           $fifteen = $positiveFifteen + $negativeFifteen;
                           if($fifteen > 45) { $fifteen = $fifteen - 45; } else { $fifteen = 0; }

                           $positiveSixteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',16)->where('game_id',$game->id)->sum('score');
                           $negativeSixteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-16)->where('game_id',$game->id)->sum('score');
                           $sixteen = $positiveSixteen + $negativeSixteen;
                           if($sixteen > 48) { $sixteen = $sixteen - 48; } else { $sixteen = 0; }

                           $positiveSeventeen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',17)->where('game_id',$game->id)->sum('score');
                           $negativeSeventeen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-17)->where('game_id',$game->id)->sum('score');
                           $seventeen = $positiveSeventeen + $negativeSeventeen;
                           if($seventeen > 51) { $seventeen = $seventeen - 51; } else { $seventeen = 0; }

                           $positiveEighteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',18)->where('game_id',$game->id)->sum('score');
                           $negativeEighteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-18)->where('game_id',$game->id)->sum('score');
                           $eighteen = $positiveEighteen + $negativeEighteen;
                           if($eighteen > 54) { $eighteen = $eighteen - 54; } else { $eighteen = 0; }

                           $positiveNineteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',19)->where('game_id',$game->id)->sum('score');
                           $negativeNineteen = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-19)->where('game_id',$game->id)->sum('score');
                           $nineteen = $positiveNineteen + $negativeNineteen;
                           if($nineteen > 57) { $nineteen = $nineteen - 57; } else { $nineteen = 0; }

                           $positiveTwenty = DB::table('dart__scores')->where('user_id', $p->id)->where('score',20)->where('game_id',$game->id)->sum('score');
                           $negativeTwenty = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-20)->where('game_id',$game->id)->sum('score');
                           $twenty = $positiveTwenty + $negativeTwenty;
                           if($twenty > 60) { $twenty = $twenty - 60; } else { $twenty = 0; }

                           $positiveBull = DB::table('dart__scores')->where('user_id', $p->id)->where('score',25)->where('game_id',$game->id)->sum('score');
                           $negativeBull = DB::table('dart__scores')->where('user_id', $p->id)->where('score',-25)->where('game_id',$game->id)->sum('score');
                           $bull = $positiveBull + $negativeBull;
                           if($bull > 75) { $bull = $bull - 75; } else { $bull = 0; }

                           echo $total = $fifteen + $sixteen + $seventeen + $eighteen + $nineteen + $twenty + $bull;
                        @endphp
                     </td>

                  </tr>
               @endforeach

            </tbody>
         </table>

         @if($game->status != 'Completed')
            <a href="{{ route('darts.cricket.players.completed', $game->id) }}" class="btn btn-sm btn-outline-info float-right">Mark Game As Completed</a>
         @endif

      </div>
      
      @include('darts.cricket.inc.footer')

   </div>

@endsection
