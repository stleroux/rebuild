<div class="bg-dark">
      <a href="{{ route('darts.index') }}" class="btn btn-primary p-1 {{ Route::is('darts') ? 'active' : '' }}">
         <i class="fa fa-bullseye"></i>
         Leader Board
      </a>

      @if(checkPerm('dart_add'))
         <a href="{{ route('darts.game.create') }}"
            class="btn btn-primary p-1
            {{ Route::is('darts.games.create') ? 'active' : '' }}
            {{ Route::is('darts.games.selectTeamsOrPlayers') ? 'active' : '' }}
            {{ Route::is('darts.games.selectPlayers') ? 'active' : '' }}
         ">
            <i class="fa fa-gamepad"></i>
            New Game
         </a>
      @endif

      @if(checkPerm('dart_browse'))
         <a href="{{ route('darts.games.board') }}"
            class="btn btn-primary p-1 {{ Route::is('darts.games.board') ? 'active' : '' }}">
            <i class="fa fa-industry"></i>
            Games Board
         </a>
      @endif
</div>

