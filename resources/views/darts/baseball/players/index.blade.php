@extends ('layouts.master')
{{-- @extends ('layouts.backend') --}}

@section('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')
   {{-- @include('darts.blocks.topbar') --}}

{{--    <form action="{{ route('darts.baseball.players.store') }}" method="POST">
      @csrf --}}

      <div class="card mb-2">

         <div class="card-header card_header p-2">
            BASEBALL - 
            @if($players->count() > 1) MULTI @else INDIVIDUAL @endif 
            PLAYER GAME
            <span class="float-right">Game ID : {{ $game->id }}</span>
         </div>
         
         <div class="card-body card_body p-2">
            <table class="table table-sm table-striped">
               <thead align="center">
                  <tr>
                     <td class="bg-primary"></td>
                     <th class="bg-dark" colspan="9"><h2>Innings</h2></th>
                     <td class="bg-primary"></td>
                  </tr>
                  <tr>
                     <th class="h2 bg-dark">Player</th>
                     @foreach($innings as $inning)
                        <th class="h2 bg-dark">
                           {{ $inning }}
                        </th>
                     @endforeach
                     <th class="h1 bg-dark">Total</th>
                  </tr>
               </thead>
               <tbody class="align-center">
                  @foreach($players as $p)
                     <tr class="text-light">
                        <td class="h2 align-middle">{{ $players->get($loop->index)->first_name }}</td>
                        @foreach($innings as $inning)
                           <td class="p-1">
                              <div class="form-group_{{$p->id}} input-group p-1 h4">
                                 <select class="custom-select custom-select-lg prc" id="" name="p{{$p->id}}[]">
                                    <option class="" value="0">0</option>
                                    @foreach($scores as $score)
                                       <option class="" value="{{ $score }}">{{ $score }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </td>
                        @endforeach
                        <td>
                           <div class="h1 text text-center text-info font-weight-bold pt-2">
                              <output id="result_{{$p->id}}"></output>
                           </div>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>

         </div>

         <div class="card-footer p-1">
            At the moment, it is not possible to save the game in the system
            <span class="text-danger float-right">Make sure you delete the game from the main list when you are done.</span>
            {{-- @if($game->status != 'Completed')
               <a href="{{ route('darts.baseball.players.completed', $game->id) }}" class="btn btn-sm btn-outline-info float-right">
                  Mark Game As Completed
               </a>
            @endif --}}
            {{-- <button type="submit" class="btn btn-secondary">Save</button> --}}
         </div>

      </div>

   {{-- </form> --}}

@endsection

@section('scripts')
   <script>
      @foreach($players as $p)
      $('.form-group_{{$p->id}}').on('input','.prc', function(){
         var totalSum = 0;
         $('.form-group_{{$p->id}} .prc').each(function(){
            var inputVal = $(this).val();
            if($.isNumeric(inputVal)){
               totalSum += parseFloat(inputVal);
            }
         });
         $('#result_{{$p->id}}').html(totalSum);
      });
      @endforeach
   </script>
@endsection
