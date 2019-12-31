@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
	@include('darts.blocks.sidebar')
@endsection

@section('content')

<div class="container-fluid">

	<div class="row">

		<div class="col">
			1 of 3
		</div>

		<div class="col-7">

			<div class="row">
				<div class="col">
					{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
						<input type="text" name="user_id" value="2" size="3">
						<input type="text" name="game_id" value="{{ $game->id }}" size="3">
						{{-- <div class="col"> --}}
							{{-- <div class="row"> --}}
								{{-- <div class="col p-0"> --}}
									<table class="table table-sm table-bordered">
										<tr>
											<td>
												<button type="submit" name="score" value="20" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td>
												@if($twenty_1_count == 1)
													<i class="fas fa-2x fa-minus-circle"></i>
												@elseif($twenty_1_count == 2)
													<i class="fas fa-2x fa-plus-circle"></i>
												@elseif($twenty_1_count == 3)
													<i class="fas fa-2x fa-times-circle"></i>
												@elseif($twenty_1_count > 3)
													{{ $twenty_1_points }}
												@endif
											</td>
											<td>
												<button type="submit" name="score" value="-20" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="19" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td>
												@if($nineteen_1_count == 1)
													<i class="fas fa-2x fa-minus-circle"></i>
												@elseif($nineteen_1_count == 2)
													<i class="fas fa-2x fa-plus-circle"></i>
												@elseif($nineteen_1_count == 3)
													<i class="fas fa-2x fa-times-circle"></i>
												@elseif($nineteen_1_count > 3)
													{{ $nineteen_1_points }}
												@endif
											</td>
											<td>
												<button type="submit" name="score" value="-19" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="18" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-18" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="17" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-17" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="16" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-16" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="15" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-15" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="50" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-50" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
									</table>
								{{-- </div> --}}
							{{-- </div> --}}
						{{-- </div> --}}
					{{ Form::close() }}
				</div>
				<div class="col bg-warning">
					<table class="table table-sm table-bordered">
						<tr>
							<td>HEADER</td>
						</tr>
						<tr>
							<td class="h4">20</td>
						</tr>
						<tr>
							<td class="h4">19</td>
						</tr>
						<tr>
							<td class="h4">18</td>
						</tr>
						<tr>
							<td class="h4">17</td>
						</tr>
						<tr>
							<td class="h4">16</td>
						</tr>
						<tr>
							<td class="h4">15</td>
						</tr>
						<tr>
							<td class="h4">Bull</td>
						</tr>
					</table>
				</div>
				<div class="col">
					
					{!! Form::open(['route'=>'darts.cricket.players.store']) !!}
						<input type="text" name="user_id" value="3" size="3">
						<input type="text" name="game_id" value="{{ $game->id }}" size="3">
						{{-- <div class="col"> --}}
							{{-- <div class="row"> --}}
								{{-- <div class="col p-0"> --}}
									<table class="table table-sm table-bordered">
										<tr>
											<td>
												<button type="submit" name="score" value="20" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td>
												@if($twenty_2_count == 1)
													<i class="fas fa-2x fa-minus-circle"></i>
												@elseif($twenty_2_count == 2)
													<i class="fas fa-2x fa-plus-circle"></i>
												@elseif($twenty_2_count == 3)
													<i class="fas fa-2x fa-times-circle"></i>
												@elseif($twenty_2_count > 3)
													popopo
												@endif
											</td>
											<td>
												<button type="submit" name="score" value="-20" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="19" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td>
												@if($nineteen_2_count == 1)
													<i class="fas fa-2x fa-minus-circle"></i>
												@elseif($nineteen_2_count == 2)
													<i class="fas fa-2x fa-plus-circle"></i>
												@elseif($nineteen_2_count == 3)
													<i class="fas fa-2x fa-times-circle"></i>
												@endif
											</td>
											<td>
												<button type="submit" name="score" value="-19" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="18" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-18" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="17" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-17" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="16" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-16" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="15" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-15" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="score" value="50" class="btn btn-sm btn-success">
													<i class="far fa-arrow-alt-circle-up"></i>
												</button>
											</td>
											<td></td>
											<td>
												<button type="submit" name="score" value="-50" class="btn btn-sm btn-danger">
													<i class="far fa-arrow-alt-circle-down"></i>
												</button>
											</td>
										</tr>
									</table>
								{{-- </div> --}}
							{{-- </div> --}}
						{{-- </div> --}}
					{{ Form::close() }}

				</div>
			</div>
		</div>
		
		<div class="col">
			3 of 3
		</div>

	</div> <!-- Enf of main row -->

</div> <!-- End of fluid container -->



	
		<div class="card-footer p-1">
			<i class="far fa-arrow-alt-circle-up"></i>
			<i class="far fa-arrow-alt-circle-down"></i>
			<i class="fas fa-times-circle"></i>
			<i class="fas fa-plus-circle"></i>
			<i class="fas fa-minus-circle"></i>
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