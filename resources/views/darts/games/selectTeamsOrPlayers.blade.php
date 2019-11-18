@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

   <div class="card mb-2">
      
      <div class="card-header section_header p-2">Create New Game - Step 2</div>
      
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-md-5">
               {!! Form::open(array('route'=>'darts.games.storeTeamsOrPlayers'), ['class'=>'form-inline']) !!}
               {{ Form::token() }}
               {{ Form::hidden('game_id', $game->id) }}
                  <div class="card mb-2">
                     <div class="card-header card_header p-2">N<sup>o</sup> Of Player(s) Per Team</div>
                     <div class="card-body card_body p-2">
                        {{-- <div class="col-md-12"> --}}
                           <div class="form-group {{ $errors->has('t_players') ? 'has-error' : '' }}">
                              {{-- {{ Form::label ('t_players', 'No Of Players Per Team', ['class'=>'required']) }} --}}
                              {{ Form::select('t_players', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'], null, ['placeholder'=>'Select...', 'class'=>'form-control form-control-sm']) }}
                              <span class="text-danger">{{ $errors->first('t_players') }}</span>
                           </div>
                     </div>
                     <div class="card-footer p-1">
                        &nbsp;
                        <span class="float-right">
                           {{ Form::submit ('Next Step', array('class'=>'btn btn-xs btn-primary')) }}
                        </span>
                     </div>
                  </div>
               {{ Form::close() }}
            </div>

            <div class="col-md-2">
               <br />
               <div class="card mb-2">
                  <div class="card-body card_body p-2">
                     <div class="text text-center"><h1>OR</h1></div>
                  </div>
               </div>
            </div>

            <div class="col-md-5">
               {!! Form::open(array('route'=>'darts.games.storeTeamsOrPlayers'), ['class'=>'form-inline']) !!}
               {{ Form::token() }}
               {{ Form::hidden('game_id', $game->id) }}
               <div class="card mb-2">
                  <div class="card-header card_header p-2">N<sup>o</sup> Of Individual Player(s)</div>
                  <div class="card-body card_body p-2">
                     <div class="col-md-12">
                        <div class="form-group {{ $errors->has('ind_players') ? 'has-error' : '' }}">
                           {{-- {{ Form::label ('ind_players', 'No of Players', ['class'=>'required']) }} --}}
                           {{ Form::select('ind_players', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'], null, ['placeholder'=>'Select...', 'class'=>'form-control form-control-sm']) }}
                           <span class="text-danger">{{ $errors->first('ind_players') }}</span>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer p-1">
                     &nbsp;
                     <span class="float-right">
                        {{ Form::submit ('Next Step', array('class'=>'btn btn-xs btn-primary')) }}
                     </span>
                  </div>
               </div>
               {{ Form::close() }}
            </div>
         </div>

      </div>

   </div>

@endsection
