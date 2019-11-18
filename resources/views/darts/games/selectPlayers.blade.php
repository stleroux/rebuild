@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

   {!! Form::open(array('route'=>'darts.games.storePlayers')) !!}
      {{ Form::token() }}
      {{-- Game ID : --}}
      {{ Form::hidden('game_id', $game->id) }}
      {{-- No Of Players : --}}
      {{ Form::hidden('players', $game->ind_players) }}

      <div class="card mb-2">
         
         <div class="card-header section_header p-2">Select The Player(s) For This Game</div>
         
         <div class="card-body card_body p-2">
            <div class="row">
               <div class="col-md-6">
                  <div class="card mb-2">
                     <div class="card-header card_header p-2">Players</div>
                     <div class="card-body card_body p-2">
                        @for ($i = 0; $i < $game->ind_players; $i++)
                           <div class="col-sm-3">
                              <label class="form-label mb-0 pb-0">Player {{ $i + 1 }}:</label>
                           </div>
                           <div class="col-sm-9 mb-3">
                              <select name="players[]" class="form-control form-control-sm">
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
               {{ Form::submit ('Create Game', array('class'=>'btn btn-xs btn-primary')) }}
            </span>
         </div>
      </div>
   {!! Form::close() !!}
@endsection