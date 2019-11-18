<div class="card mb-3 p-0 m-0">

   <div class="card-header block_header p-2 m-0">Darts Menu</div>

   <div class="list-group">

      <a href="{{ route('darts.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('darts.index') ? 'active' : '' }}">
         <i class="fa fa-bullseye"></i>
         Leader Board
      </a>

      <a href="{{ route('darts.game.create') }}"
         class="list-group-item list-group-item-action p-1
         {{ Route::is('darts.games.create') ? 'active' : '' }}
         {{ Route::is('darts.games.selectTeamsOrPlayers') ? 'active' : '' }}
         {{ Route::is('darts.games.selectPlayers') ? 'active' : '' }}
      ">
         <i class="fa fa-gamepad"></i>
         New Game
      </a>

      <a href="{{ route('darts.games.board') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('darts.games.board') ? 'active' : '' }}">
         <i class="fa fa-industry"></i>
         Games Board
      </a>

   </div>
</div>
