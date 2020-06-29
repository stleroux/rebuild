@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

{!! Form::open(array('route'=>'darts.games.storeTeamsOrPlayers'), ['class'=>'form-inline']) !!}
   {{ Form::hidden('game_id', $game->id) }}

   <div class="card mb-2">
      <div class="card-header section_header p-2">Create New Game - Step 2</div>
      <div class="card-body section_body p-2">

         @if(!in_array($game->type, $gameTypes))

            @if(!in_array($game->type, $gameTypes))
               <div class="row col">
            @endif

            {{-- PLAYERS PER TEAM --}}
            <div @if(!in_array($game->type, $gameTypes)) class="col-5" @endif>
               <div class="card mb-2">
                  <div class="card-header card_header p-2">N<sup>o</sup> Of Player(s) Per Team</div>
                  <div class="card-body card_body pb-2">
                     <div class="form-group {{ $errors->has('t_players') ? 'has-error' : '' }}">
                        {{ Form::select('t_players', [
                           '2'=>'2 players per team = 4 players total',
                           '3'=>'3 players per team = 6 players total',
                           '4'=>'4 players per team = 8 players total',
                           '5'=>'5 players per team = 10 players total'], null, ['placeholder'=>'Select...', 'class'=>'form-control form-control-sm']) }}
                        <span class="text-danger">{{ $errors->first('t_players') }}</span>
                     </div>
                  </div>
               </div>
            </div>
         
            {{-- OR --}}
            <div @if(!in_array($game->type, $gameTypes)) class="col-2" @endif>
               <div class="card mt-4 mb-2">
                  <div class="card-body card_body p-2">
                     <div class="text text-center"><h1>OR</h1></div>
                  </div>
               </div>
            </div>

         @endif

            
         <div @if(!in_array($game->type, $gameTypes)) class="col-5" @endif>

            {{-- PLAYERS --}}
            <div class="card mb-2">
               <div class="card-header card_header p-2">N<sup>o</sup> Of Individual Player(s)</div>
               <div class="card-body card_body pb-2">
                  <div @if(in_array($game->type, $gameTypes)) class="col-3" @endif>
                     <div class="form-group {{ $errors->has('ind_players') ? 'has-error' : '' }}">
                        {{ Form::select('ind_players', [
                           '1'=>'1 player (Practice Mode)',
                           '2'=>'2 players',
                           '3'=>'3 players',
                           '4'=>'4 players',
                           '5'=>'5 players',
                           '6'=>'6 players',
                           '7'=>'7 players',
                           '8'=>'8 players',
                           '9'=>'9 players',
                           '10'=>'10 players'],
                           null,
                           ['placeholder'=>'Select...', 'class'=>'form-control form-control-sm']) }}
                        <span class="text-danger">{{ $errors->first('ind_players') }}</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         @if(!in_array($game->type, $gameTypes))
            </div>
         @endif

      </div>

      <div class="card-footer p-1">
         <span class="float-right">
            {{ Form::submit ('Next Step', array('class'=>'btn btn-sm btn-primary')) }}
         </span>
      </div>

   </div>

{{ Form::close() }}

@endsection
