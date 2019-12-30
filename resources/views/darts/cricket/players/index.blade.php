@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('darts.blocks.sidebar')
@endsection

@section('content')
<div class="container-fluid border">
	<div class="row border">
		<div class="col border">
			1 of 3
		</div>
		<div class="col-7 border">
			2 of 3 (wider)
		</div>
		<div class="col border">
			3 of 3
		</div>
	</div>
</div>





<hr>
<hr>
<hr>
	<div class="col-6 mx-auto border">
		<div class="row">
			{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
				<input type="text" name="user_id" value="2" size="3">
				<input type="text" name="game_id" value="{{ $game->id }}" size="3">

				<div class="col-4 border">
					<div class="row">
						<div class="col p-0">
							<table class="table table-sm table-bordered">
								<tr>
									<td>
										<button type="submit" name="score" value="20" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="19" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="18" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="17" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="16" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="15" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="50" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									</td>
								</tr>
							</table>
						</div>
						<div class="col p-0 border">
							ICONS                     
						</div>
						<div class="col p-0 border">
							<table class="table table-sm table-bordered">
								<tr>
									<td>
										<button type="submit" name="score" value="-20" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="-19" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="-18" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="-17" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="-16" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="-15" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit" name="score" value="-50" class="btn btn-sm btn-danger">
											<i class="far fa-arrow-alt-circle-down"></i>
										</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			{{ Form::close() }}
				{{-- <div class="col-4 bg-secondary">SCORES</div> --}}
				{{-- <div class="col-4 bg-secondary">3</div> --}}
		</div>
	</div>






{{-- {!! Form::open(['route'=>'darts.cricket.players.store']) !!} --}}

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
								<th>Stephane</th>
								<th></th>
								<th>Score</th>
								<th></th>
								<th>Stacie</th>
								<th></th>
							</tr>
						</thead>
						<tbody align="center">
<!------------------------------------------------------------------------------------------>


							<tr>
								<td>
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="text" name="user_id" value="2">
										<input type="text" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="20" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
<td>
Return twenty_1_total result
</td>
								<td>
									<button type="submit" name="action" value="twenty_1_minus" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</button>
								</td>
								<th class="h1">20</th>
								<td>
									<button type="submit" name="action" value="twenty_2_minus" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</button>
								</td>
<td></td>
								<td>
									<button type="submit" name="action" value="twenty_2_plus" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</button>
								</td>
							</tr>



<!------------------------------------------------------------------------------------------>
							<tr>
								<td>
									{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
										<input type="text" name="user_id" value="2">
										<input type="text" name="game_id" value="{{ $game->id }}">
										<button type="submit" name="score" value="19" class="btn btn-sm btn-success">
											<i class="far fa-arrow-alt-circle-up"></i>
										</button>
									{{ Form::close() }}
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
								<th class="h1">19</th>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
								<th class="h1">18</th>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
								<th class="h1">17</th>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
								<th class="h1">16</th>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
								<th class="h1">15</th>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
								<th class="h1">BULL</th>
								<td>
									<a href="#" class="btn btn-sm btn-danger">
										<i class="far fa-arrow-alt-circle-down"></i>
									</a>
								</td>
<td></td>
								<td>
									<a href="#" class="btn btn-sm btn-success">
										<i class="far fa-arrow-alt-circle-up"></i>
									</a>
								</td>
							</tr>
<!------------------------------------------------------------------------------------------>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<th class="h1">TOTAL</th>
								<td></td>
								<td></td>
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