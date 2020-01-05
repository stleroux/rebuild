<tr>
   <td class="align-middle">
      {!! Form::open(['route'=>'darts.cricket.players.store']) !!}
         <input type="hidden" name="user_id" value="1">
         <input type="hidden" name="game_id" value="{{ $game->id }}">
         <button type="submit" name="score" value="19" class="btn btn-sm btn-success" {{ ($game->status == 'Completed') ? 'disabled' : '' }}>
            <i class="far fa-2x fa-arrow-alt-circle-up"></i>
         </button>
      {{ Form::close() }}
   </td>
   <td class="align-middle">
      @if($nineteen_1_count == 1)
         <i class="fas fa-2x fa-minus-circle"></i>
      @elseif($nineteen_1_count == 2)
         <i class="fas fa-2x fa-plus-circle"></i>
      @elseif($nineteen_1_count == 3)
         <i class="fas fa-2x fa-times-circle"></i>
      @elseif($nineteen_1_count > 3)
         <h2 class="pt-1">{{ $nineteen_1_points }}</h2>
      @endif
   </td>
   <td class="align-middle">
      {!! Form::open(['route'=>'darts.cricket.players.store']) !!}
         <input type="hidden" name="user_id" value="1">
         <input type="hidden" name="game_id" value="{{ $game->id }}">
         <button type="submit" name="score" value="-19" class="btn btn-sm btn-danger" {{ ($game->status == 'Completed') ? 'disabled' : '' }}>
            <i class="far fa-2x fa-arrow-alt-circle-down "></i>
         </button>
      {{ Form::close() }}
   </td>

   <th class="h1 bg-dark">19</th>

   <td class="align-middle">
      {!! Form::open(['route'=>'darts.cricket.players.store']) !!}
         <input type="hidden" name="user_id" value="2">
         <input type="hidden" name="game_id" value="{{ $game->id }}">
         <button type="submit" name="score" value="-19" class="btn btn-sm btn-danger" {{ ($game->status == 'Completed') ? 'disabled' : '' }}>
            <i class="far fa-2x fa-arrow-alt-circle-down "></i>
         </button>
      {{ Form::close() }}
   </td>
   <td class="align-middle">
      @if($nineteen_2_count == 1)
         <i class="fas fa-2x fa-minus-circle"></i>
      @elseif($nineteen_2_count == 2)
         <i class="fas fa-2x fa-plus-circle"></i>
      @elseif($nineteen_2_count == 3)
         <i class="fas fa-2x fa-times-circle"></i>
      @elseif($nineteen_2_count > 3)
         <h2 class="pt-1">{{ $nineteen_2_points }}</h2>
      @endif
   </td>
   <td class="align-middle">
      {!! Form::open(['route'=>'darts.cricket.players.store']) !!}
         <input type="hidden" name="user_id" value="2">
         <input type="hidden" name="game_id" value="{{ $game->id }}">
         <button type="submit" name="score" value="19" class="btn btn-sm btn-success" {{ ($game->status == 'Completed') ? 'disabled' : '' }}>
            <i class="far fa-2x fa-arrow-alt-circle-up"></i>
         </button>
      {{ Form::close() }}
   </td>
</tr>
