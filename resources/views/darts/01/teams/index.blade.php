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

   @isset($teamGameDone)
      @if(!$teamGameDone)
         @include('darts.inc.scoreboard')
      @endif
   @endisset
	
	<div class="form-row">
		<div class="col-sm-4">
			@include('darts.01.teams.t1scorePanel')
			@include('darts.01.teams.t1scoresheet')
		</div>

		<div class="col-sm-4">
         @include('darts.01.teams.messages')
			@include('darts.01.teams.dartboard')
         @include('darts.01.teams.gameInfo')
			@include('darts.01.teams.teamStats')
			@include('darts.01.teams.playerStats')
		</div>

		<div class="col-sm-4">
			@include('darts.01.teams.t2scorePanel')
			@include('darts.01.teams.t2scoresheet')
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
      $('#display-dart-empty').hide();
      setTimeout(function() {
         $('#display-dart-success').remove();
         // $('#display-dart-danger').remove();
         $('#display-dart-error').remove();
         $('#display-dart-empty').show();
      }, 5000); // <-- time in milliseconds
   </script>
@endsection
