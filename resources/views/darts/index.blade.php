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
         <table class="table table-sm table-striped table-hover">
            <thead>
               <tr>
                  <td></td>
                  <td colspan="3">01 - Team</td>
                  <td colspan="3">01 - Individual</td>
                  <td colspan="2">Cricket - Team</td>
                  <td colspan="2">Cricket - Individual</td>
                  <td></td>
               </tr>
               <tr>
                  <th>Player Name</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th>Best Score</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th>Best Score</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach($players as $player)
                  <tr>
                     <td>{{ $player->first_name }}</td>
                     <td>
                        {{ dd($player) }}
                     </td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="card-footer p-1">
         Footer
      </div>
   </div>
@endsection
