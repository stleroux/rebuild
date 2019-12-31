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
			CRICKET - PLAYER GAME
			<span class="float-right">Game ID : {{ $game->id }}</span>
		</div>
		<div class="card-body card_body p-2">
				<div class="col-6 mx-auto">
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


<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="20" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($twenty_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($twenty_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($twenty_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($twenty_1_count > 3)
										<h2 class="pt-1">{{ $twenty_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-20" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">20</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-20" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($twenty_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($twenty_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($twenty_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($twenty_2_count > 3)
										<h2 class="pt-1">{{ $twenty_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="20" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="19" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($nineteen_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($nineteen_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($nineteen_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($nineteen_1_count > 3)
										<h2 class="pt-1">{{ $nineteen_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-19" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">19</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-19" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($nineteen_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($nineteen_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($nineteen_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($nineteen_2_count > 3)
										<h2 class="pt-1">{{ $nineteen_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="19" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="18" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($eighteen_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($eighteen_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($eighteen_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($eighteen_1_count > 3)
										<h2 class="pt-1">{{ $eighteen_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-18" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">18</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-18" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($eighteen_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($eighteen_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($eighteen_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($eighteen_2_count > 3)
										<h2 class="pt-1">{{ $eighteen_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="18" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="17" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($seventeen_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($seventeen_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($seventeen_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($seventeen_1_count > 3)
										<h2 class="pt-1">{{ $seventeen_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-17" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">17</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-17" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($seventeen_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($seventeen_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($seventeen_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($seventeen_2_count > 3)
										<h2 class="pt-1">{{ $seventeen_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="17" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="16" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($sixteen_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($sixteen_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($sixteen_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($sixteen_1_count > 3)
										<h2 class="pt-1">{{ $sixteen_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-16" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">16</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-16" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($sixteen_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($sixteen_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($sixteen_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($sixteen_2_count > 3)
										<h2 class="pt-1">{{ $sixteen_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="16" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="15" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($fifteen_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($fifteen_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($fifteen_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($fifteen_1_count > 3)
										<h2 class="pt-1">{{ $fifteen_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-15" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">15</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-15" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($fifteen_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($fifteen_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($fifteen_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($fifteen_2_count > 3)
										<h2 class="pt-1">{{ $fifteen_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="15" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="25" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($bull_1_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($bull_1_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($bull_1_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($bull_1_count > 3)
										<h2 class="pt-1">{{ $bull_1_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="1">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-25" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>

								<th class="h1 bg-dark">Bull</th>

								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="-25" class="btn btn-sm btn-danger">
											<i class="far fa-2x fa-arrow-alt-circle-down	"></i>
										</button>
									{{ Form::close() }}
								</td>
								<td class="align-middle">
									@if($bull_2_count == 1)
										<i class="fas fa-2x fa-minus-circle"></i>
									@elseif($bull_2_count == 2)
										<i class="fas fa-2x fa-plus-circle"></i>
									@elseif($bull_2_count == 3)
										<i class="fas fa-2x fa-times-circle"></i>
									@elseif($bull_2_count > 3)
										<h2 class="pt-1">{{ $bull_2_points }}</h2>
									@endif
								</td>
								<td class="align-middle">
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="hidden" name="team_id" value="2">
										<input type="hidden" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="25" class="btn btn-sm btn-success">
											<i class="far fa-2x fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr class="bg-dark">
								<td></td>
								<td class="h1">{{ $team_1_total_points }}</td>
								<td></td>
								<th class="h1 bg-dark align-center">TOTAL</th>
								<td></td>
								<td class="h1">{{ $team_2_total_points }}</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
		</div>
		<div class="card-footer p-1">
			<i class="far fa-arrow-alt-circle-up"></i>
			<i class="far fa-arrow-alt-circle-down"></i>
			<i class="fas fa-times-circle"></i>
			<i class="fas fa-plus-circle"></i>
			<i class="fas fa-minus-circle"></i>
		</div>
	</div>

{{-- {{ Form::close() }} --}}

{{-- 
bull  => b
15    => f
16    => si
17    => se
18    => e
19    => n
20    => t


twenty_1_plus
twenty_1_minus
twenty_1_total

twenty_2_plus
twenty_2_minus
twenty_2_total
 --}}
@endsection