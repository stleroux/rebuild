@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

	{!! Form::open(array('route'=>'darts.games.storeTeamPlayers')) !!}
		{{ Form::token() }}
		{{-- Game ID : --}}
		{{ Form::hidden('game_id', $game->id) }}
		{{-- Team 1 No Players : --}}
		{{ Form::hidden('t_players', $game->t1_players) }}
		{{-- Team 2 No Players : --}}
		{{ Form::hidden('t2_players', $game->t2_players) }}

		<div class="card mb-2">
			
			<div class="card-header section_header p-2">Select Each Team's Player(s) For This Game</div>
			
			<div class="card-body card_body p-2">
            <div class="row">
               <div class="col-md-6">
						<div class="card mb-2">
							<div class="card-header card_header p-2">Team 1 Players</div>
							<div class="card-body card_body p-2">
								@for ($i = 0; $i < $game->t1_players; $i++)
									<div class="col-sm-3">
										<label class="form-label mb-0 pb-0">Player {{ $i + 1 }}:</label>
									</div>
									<div class="col-sm-9 mb-3">
										<select name="team1players[]" class="form-control form-control-sm">
											<option value="">Select A Player</option>
											@foreach($players as $user)
												<option name="player_{{ $i }}" value="{{ $user->id }}">{{ $user->last_name }}, {{ $user->first_name }}</option>
											@endforeach
										</select>
									</div>
								@endfor
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card mb-2">
							<div class="card-header card_header p-2">Team 2 Players</div>
							<div class="card-body card_body p-2">
								@for ($i = 0; $i < $game->t2_players; $i++)
									<div class="col-sm-3">
										<label class="form-label mb-0 pb-0">Player {{ $i + 1 }}:</label>
									</div>
									<div class="col-sm-9 mb-3">
										<select name="team2players[]" class="form-control form-control-sm">
											<option value="">Select A Player</option>
											@foreach($players as $user)
												<option name="player_{{ $i }}" value="{{ $user->id }}">{{ $user->last_name }}, {{ $user->first_name }}</option>
											@endforeach
										</select>
									</div>
								@endfor
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="card-footer p-1">
				Fields marked with an<span class="required"></span> are required.
				<span class="float-right">
					{{ Form::submit ('Create Game', array('class'=>'btn btn-sm btn-primary')) }}
				</span>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
