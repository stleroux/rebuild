<div class="card mb-3 p-0 m-0">

   <div class="card-header block_header p-2 m-0">Darts Menu</div>

   <div class="list-group">

      <a href="{{ route('darts.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('darts.index') ? 'active' : '' }}">
         <i class="fa fa-bullseye"></i>
         Leader Board
      </a>

      @if(checkPerm('dart_add'))
         <a href="{{ route('darts.game.create') }}"
            class="list-group-item list-group-item-action p-1
            {{ Route::is('darts.games.create') ? 'active' : '' }}
            {{ Route::is('darts.games.selectTeamsOrPlayers') ? 'active' : '' }}
            {{ Route::is('darts.games.selectPlayers') ? 'active' : '' }}
         ">
            <i class="fa fa-gamepad"></i>
            New Game
         </a>
      @endif

      @if(checkPerm('dart_browse'))
         <a href="{{ route('darts.games.board') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('darts.games.board') ? 'active' : '' }}">
            <i class="fa fa-industry"></i>
            Games Board
         </a>
      @endif

   </div>
</div>

@isset($gameDone)
   @if(!$gameDone)
      @include('darts.01.inc.possibleOuts', ['score'=>$remainingScore, 'user'=>$user])
   @endif
@endisset

@isset($teamGameDone)
   @if(!$teamGameDone)
      @include('darts.01.inc.possibleOuts', ['score'=>$remainingScore, 'user'=>$user])
   @endif
@endisset

