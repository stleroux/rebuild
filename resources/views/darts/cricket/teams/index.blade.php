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
         CRICKET - TEAM GAME
         <span class="float-right">Game ID : {{ $game->id }}</span>
      </div>
      
      <div class="card-body card_body p-2">
         
         <div class="form-row">

            <div class="col">
               <div class="card mb-2">
                  <div class="card-header p-2">Team 1 Players</div>
                  <div class="card-body p-2">
                     <ul class="list-group">
                        @foreach($team_1_players as $p)
                           <li class="list-group-item text text-center">{{ $p->first_name }}</li>
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>
            
            <div class="col-7 mx-auto">
               <table class="table table-sm table-bordered">
                  <thead align="center">
                     <tr class="h3">
                        <th></th>
                        <th>Team 1</th>
                        <th></th>
                        <th>Score</th>
                        <th></th>
                        <th>Team 2</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody align="center" class="bg-secondary">
                     @include('darts.cricket.teams.inc.20')
                     @include('darts.cricket.teams.inc.19')
                     @include('darts.cricket.teams.inc.18')
                     @include('darts.cricket.teams.inc.17')
                     @include('darts.cricket.teams.inc.16')
                     @include('darts.cricket.teams.inc.15')
                     @include('darts.cricket.teams.inc.bull')
                     @include('darts.cricket.teams.inc.totals')
                  </tbody>
               </table>
            </div>
            
            <div class="col">
               <div class="card mb-2">
                  <div class="card-header p-2">Team 2 Players</div>
                  <div class="card-body p-2">
                     <ul class="list-group">
                        @foreach($team_2_players as $p)
                           <li class="list-group-item text text-center">{{ $p->first_name }}</li>
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>

         </div>
         
         @if($game->status != 'Completed')
            <a href="{{ route('darts.cricket.teams.completed', $game->id) }}" class="btn btn-sm btn-outline-info float-right">Mark Game As Completed</a>
         @endif

      </div>
      
      @include('darts.cricket.inc.footer')

   </div>

@endsection
