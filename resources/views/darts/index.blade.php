@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

   <div class="card mb-2">
      <div class="card-header section_header p-2">
         Dart Keeper
      </div>
      <div class="card-body section_body p-2">
         <div class="form-row">
            <div class="col">
               <div class="card">
                  <div class="card-header card_header p-2">01 Team Stats</div>
                  <table class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th>Player Name</th>
                           <th class="text-center">Played</th>
                           <th class="text-center">Won</th>
                           <th class="text-center">Lost</th>
                           <th class="text-center">Best Score</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($players as $player)
                           <tr>
                              <td>{{ $player->first_name }}</td>
                              <td class="text-center">{{ zeroOnePlayerTeamGamesPlayedStat($player) }}</td>
                              <td class="text-center">{{ zeroOnePlayerTeamGamesWonStat($player) }}</td>
                              <td class="text-center">{{ zeroOnePlayerTeamGamesLostStat($player) }}</td>
                              <td class="text-center">{{ zeroOnePlayerBestScoreTeamStat($player) }}</td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="col">
               <div class="card mb-2">
                  <div class="card-header card_header p-2">01 Individual Stats</div>
                  <table class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th>Player Name</th>
                           <th class="text-center">Played</th>
                           <th class="text-center">Won</th>
                           <th class="text-center">Lost</th>
                           <th class="text-center">Best Score</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($players as $player)
                           <tr>
                              <td>{{ $player->first_name }}</td>
                              <td class="text-center">{{ zeroOnePlayerindividualGamesPlayedStat($player) }}</td>
                              <td class="text-center">{{ zeroOnePlayerindividualGamesWonStat($player) }}</td>
                              <td class="text-center">{{ zeroOnePlayerindividualGamesLostStat($player) }}</td>
                              <td class="text-center">{{ zeroOnePlayerBestScoreindividualStat($player) }}</td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

         <div class="form-row">
            <div class="col">
               <div class="card">
                  <div class="card-header card_header p-2">Cricket Team Stats</div>
                  <table class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th>Player Name</th>
                           <th class="text-center">Played</th>
                           <th class="text-center">Won</th>
                           <th class="text-center">Lost</th>
                           <th class="text-center">Best Score</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($players as $player)
                           <tr>
                              <td>{{ $player->first_name }}</td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="col">
               <div class="card">
                  <div class="card-header card_header p-2">Cricket Individual Stats</div>
                  <table class="table table-sm table-hover">
                     <thead>
                        <tr>
                           <th>Player Name</th>
                           <th class="text-center">Played</th>
                           <th class="text-center">Won</th>
                           <th class="text-center">Lost</th>
                           <th class="text-center">Best Score</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($players as $player)
                           <tr>
                              <td>{{ $player->first_name }}</td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection