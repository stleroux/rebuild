@extends('layouts.master')

@section('stylesheets')
	<style>
		.hover { background-color: grey; }
		.thead tr th { color: yellow; }

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

{!! Form::open(['route' => 'darts.01.teams.store', 'class'=>'inline-form']) !!}

   @isset($teamGameDone)
      @if(!$teamGameDone)
         @include('darts.01.inc.scoreboard')
      @endif
   @endisset
	
	<div class="form-row">
		<div class="col-sm-4">
			@include('darts.01.teams.t1playersPanel')
			@include('darts.01.teams.t1scoresheet')
		</div>

		<div class="col-sm-4">
         @isset($teamGameDone)
            @if(!$teamGameDone)
               @include('darts.01.teams.scorePad')
			      @include('darts.01.inc.dartboard')
            @endif
         @endisset
         @include('darts.01.teams.gameInfo')
			@include('darts.01.teams.teamStats')
			@include('darts.01.teams.playerStats')
		</div>

		<div class="col-sm-4">
			@include('darts.01.teams.t2playersPanel')
			@include('darts.01.teams.t2scoresheet')
		</div>
	</div>

{{ Form::close() }}

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
@endsection
