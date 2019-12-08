{{-- @extends('darts.layouts.app') --}}
@extends('layouts.master')

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
{{-- {{ $user }} --}}
{{-- {{ dd($game->type) }} --}}
{{-- {{ dd(zeroOneTeamScores($game, 2)->sum('score')) }} --}}
{{-- {{ dd(zeroOneTeamScores($game, 1)->sum('score')) }} --}}
{{-- {{ dd($game->type - zeroOneTeamScores($game, 2)->sum('score')) }} --}}
{{-- {{ dd($game->type - zeroOneTeamScores($game, 1)->sum('score')) }} --}}

	{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') != 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') != 0)) --}}
{{-- {{ $teamGameDone }} --}}

   {{-- <div class="col-xs-12">
      <div class="card mb-2">
         <div class="card-header p-2">
            Team Game
            <div class="float-right">Game Type : {{ $game->type }}</div>
         </div>
      </div>
   </div> --}}

   @isset($teamGameDone)
      @if(!$teamGameDone)
         @include('darts.inc.scoreboard')
      @endif
   @endisset
	
	{{-- {!! Form::open(['route' => 'darts.01.scores.teams.store']) !!} --}}
	<div class="form-row">
		<div class="col-sm-4">
			@include('darts.01.scores.teams.t1scorePanel')
			@include('darts.01.scores.teams.t1scoresheet')
		</div>

		<div class="col-sm-4">
			@include('darts.01.scores.teams.gameInfo')
			@include('darts.01.scores.teams.teamStats')
			@include('darts.01.scores.teams.playerStats')
		</div>

		<div class="col-sm-4">
			@include('darts.01.scores.teams.t2scorePanel')
			@include('darts.01.scores.teams.t2scoresheet')
		</div>
	</div>
	{{-- {{ Form::close() }} --}}

	<div class="form-row">
		<div class="col-sm-4">
			{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') != 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') != 0))
				@include('darts.01.scores.teams.t1possibleOuts')
			@endif --}}
		</div>

		<div class="col-sm-4">
		</div>

		<div class="col-sm-4">
			{{-- @if(($game->type - zeroOneTeamScores($game, 2)->sum('score') != 0) || ($game->type - zeroOneTeamScores($game, 1)->sum('score') != 0))
				@include('darts.01.scores.teams.t2possibleOuts')
			@endif --}}
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

   <script type="text/javascript">
      // $(document).ready(function () {
      //    window.setTimeout(function() {
      //       $(".alert").fadeTo(1500, 0).slideUp(1500, function(){
      //          $(this).remove(); 
      //       });
      //    }, 7000);
      // });


      $(document).ready(function(){
         $('#display-dart-success').fadeIn().delay(4000).fadeOut();
         $('#display-dart-error').fadeIn().delay(8000).fadeOut();
         $('#display-dart-danger').fadeIn().delay(8000).fadeOut();
      });

   </script>
@endsection
