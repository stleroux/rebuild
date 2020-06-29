@extends ('layouts.master')
{{-- @extends ('layouts.backend') --}}

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')
   {{-- @include('darts.blocks.topbar') --}}

	<div class="card">
		
		<div class="card-header section_header p-2">Dart Games</div>

		<div class="card-body section_body p-2">
			@if($games->count() > 0)
				<table class="table table-sm table-hover table-striped">
					<thead>
						<tr>
							<th>Game N<sup>o</sup></th>
							<th>Type</th>
							<th class="d-none d-lg-table-cell">Team 1 Players</th>
							<th class="d-none d-lg-table-cell">Team 2 Players</th>
							<th class="d-none d-lg-table-cell">Players</th>
							<th class="">Date</th>
							<th class="d-none d-md-table-cell">Winner</th>
							<th class="d-none d-sm-table-cell">Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($games as $game)
							<tr class="text-light">
                        <!-- Gamwe ID -->
								<td>{{ $game->id}}</td>
                        <!-- Game Type -->
								<td>{{ ucfirst($game->type) }}</td>
                        <!-- Team 1 Players -->
								<td class="d-none d-lg-table-cell">
									@foreach(zeroOneTeamPlayers($game, 1) as $player)
										{{ $player->first_name }}
										@if (!$loop->last)
											&nbsp;/&nbsp;
										@endif
									@endforeach
								</td>
                        <!-- Team 2 Players -->
								<td class="d-none d-lg-table-cell">
									@foreach(zeroOneTeamPlayers($game, 2) as $player)
										{{ $player->first_name }}
										@if (!$loop->last)
											&nbsp;/&nbsp;
										@endif
									@endforeach
								</td>
                        <!-- Players -->
								<td class="d-none d-lg-table-cell">
									@if($game->ind_players)
										@foreach(zeroOnePlayers($game->id) as $player)
											{{ $player->first_name }}
											@if (!$loop->last)
												&nbsp;/&nbsp;
											@endif
										@endforeach
									@endif
								</td>
                        <!-- Date -->
								<td class="">{{ $game->created_at->format('M d, Y') }}</td>
								<!-- Winner -->
                        <td class="d-none d-md-table-cell">
									@if($game->type == '301' || $game->type == '501' || $game->type == '701' || $game->type == '1001')
										{{ zeroOneGameWinner($game) }}
									@elseif($game->type == 'cricket')
										{{ cricketGameWinner($game) }}
									@endif
								</td>
                        <!-- Status -->
								<td class="d-none d-sm-table-cell">{{ $game->status }}</td>
                        <!-- Options -->
								<td class="text-right">
									@if($game->type == 'cricket')
										{{-- Individual player game --}}
										@if($game->ind_players)
											@if($game->status == 'New')
												<a href="{{ route('darts.cricket.players.index', $game->id) }}" class="btn btn-sm btn-success col-xs-1 py-0 px-1">Start</a>
											@elseif($game->status == 'In Progress')
												<a href="{{ route('darts.cricket.players.index', $game->id) }}" class="btn btn-sm btn-warning col-xs-1 py-0 px-1">Resume</a>
											@elseif($game->status == 'Completed')
												<a href="{{ route('darts.cricket.players.index', $game->id) }}" class="btn btn-sm btn-primary col-sx-1 py-0 px-1">Results</a>
											@else
												N/A
											@endif
										@else
										{{-- Team game --}}
											@if($game->status == 'New')
												<a href="{{ route('darts.cricket.teams.index', $game->id) }}" class="btn btn-sm btn-success col-sx-1 py-0 px-1">Start</a>
											@elseif($game->status == 'In Progress')
												<a href="{{ route('darts.cricket.teams.index', $game->id) }}" class="btn btn-sm btn-warning col-sx-1 py-0 px-1">Resume</a>
											@elseif($game->status == 'Completed')
												<a href="{{ route('darts.cricket.teams.index', $game->id) }}" class="btn btn-sm btn-primary col-sx-1 py-0 px-1">Results</a>
											@else
												N/A
											@endif
										@endif
                           @elseif($game->type == 'baseball')
                              {{-- Individual player game --}}
                              @if($game->ind_players)
                                 @if($game->status == 'New')
                                    <a href="{{ route('darts.baseball.players.index', $game->id) }}" class="btn btn-sm btn-success col-xs-1 py-0 px-1">Start</a>
                                 @elseif($game->status == 'In Progress')
                                    <a href="{{ route('darts.baseball.players.index', $game->id) }}" class="btn btn-sm btn-warning col-xs-1 py-0 px-1">Resume</a>
                                 @elseif($game->status == 'Completed')
                                    <a href="{{ route('darts.baseball.players.index', $game->id) }}" class="btn btn-sm btn-primary col-sx-1 py-0 px-1">Results</a>
                                 @else
                                    N/A
                                 @endif
                              @else
                              {{-- Team game --}}
                                 {{-- @if($game->status == 'New')
                                    <a href="{{ route('darts.baseball.teams.index', $game->id) }}" class="btn btn-sm btn-success col-sx-1 py-0 px-1">Start</a>
                                 @elseif($game->status == 'In Progress')
                                    <a href="{{ route('darts.baseball.teams.index', $game->id) }}" class="btn btn-sm btn-warning col-sx-1 py-0 px-1">Resume</a>
                                 @elseif($game->status == 'Completed')
                                    <a href="{{ route('darts.baseball.teams.index', $game->id) }}" class="btn btn-sm btn-primary col-sx-1 py-0 px-1">Results</a>
                                 @else
                                    N/A
                                 @endif --}}
                              @endif
                           @elseif($game->type == 'around')
                              {{-- Individual player game --}}
                              @if($game->ind_players)
                                 @if($game->status == 'New')
                                    <a href="{{ route('darts.around.players.index', $game->id) }}" class="btn btn-sm btn-success col-xs-1 py-0 px-1">Start</a>
                                 @elseif($game->status == 'In Progress')
                                    <a href="{{ route('darts.around.players.index', $game->id) }}" class="btn btn-sm btn-warning col-xs-1 py-0 px-1">Resume</a>
                                 @elseif($game->status == 'Completed')
                                    <a href="{{ route('darts.around.players.index', $game->id) }}" class="btn btn-sm btn-primary col-sx-1 py-0 px-1">Results</a>
                                 @else
                                    N/A
                                 @endif
                              @else
                              {{-- Team game --}}
                                 {{-- @if($game->status == 'New')
                                    <a href="{{ route('darts.around.teams.index', $game->id) }}" class="btn btn-sm btn-success col-sx-1 py-0 px-1">Start</a>
                                 @elseif($game->status == 'In Progress')
                                    <a href="{{ route('darts.around.teams.index', $game->id) }}" class="btn btn-sm btn-warning col-sx-1 py-0 px-1">Resume</a>
                                 @elseif($game->status == 'Completed')
                                    <a href="{{ route('darts.around.teams.index', $game->id) }}" class="btn btn-sm btn-primary col-sx-1 py-0 px-1">Results</a>
                                 @else
                                    N/A
                                 @endif --}}
                              @endif
									@else
										{{-- Individual player game --}}
										@if($game->ind_players)
											<div class="btn-group" role="group">
   											@if($game->status == 'New')
   												<a href="{{ route('darts.01.players.index', $game->id) }}" class="text-light btn btn-success btn-sm py-0 px-1">Start</a>
   											@elseif($game->status == 'In Progress')
   												<a href="{{ route('darts.01.players.index', $game->id) }}" class="text-light btn btn-warning btn-sm py-0 px-1">Resume</a>
   											@elseif($game->status == 'Completed')
   												<a href="{{ route('darts.01.players.index', $game->id) }}" class="text-light btn btn-primary btn-sm py-0 px-1">Results</a>
   											@else
   												N/A
   											@endif
											</div>
										@else
   										{{-- Team game --}}
   										<div class="btn-group" role="group">
   											@if($game->status == 'New')
   												<a href="{{ route('darts.01.teams.index', $game->id) }}" class="text-light btn btn-success btn-sm py-0 px-1">Start</a>
   											@elseif($game->status == 'In Progress')
   												<a href="{{ route('darts.01.teams.index', $game->id) }}" class="text-light btn btn-warning btn-sm py-0 px-1">Resume</a>
   											@elseif($game->status == 'Completed')
   												<a href="{{ route('darts.01.teams.index', $game->id) }}" class="text-light btn btn-primary btn-sm py-0 px-1">Results</a>
   											@else
   												N/A
   											@endif
   									   </div>
									   @endif
									@endif

									@if(checkPerm('dart_delete'))
										{!! Form::open(['action' => ['Darts\GamesController@destroy', $game->id], 'method'=>'POST', 'style'=>'display:inline;', 'onsubmit' => 'return confirm("Are you sure you want to delete this game and all related entries?")']) !!}
											{{ Form::hidden('_method', 'DELETE') }}
											{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-sm py-0 px-1']) !!}
										{!! Form::close() !!}
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{ $games->links() }}
			@else
				{{ setting('no_records_found') }}
			@endif
		</div>

		<div class="card-footer card_footer p-1">
			Games marked as practice are not accounted for in the Leader Board statistics
		</div>
	</div>

@endsection
