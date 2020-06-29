@extends ('layouts.backend')

@section('stylesheets')
   <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('left_column')
@endsection

@section('right_column')
   {{-- @include('darts.blocks.sidebar') --}}
@endsection

@section('content')
@include('darts.blocks.topbar')




{{--       <table class="table table-bordered table-sm">
         <thead>
            <tr>
               <th colspan="21">Stacie</th>
            </tr>
         </thead>
         <tbody>
            <tr>
            @foreach($pies as $pie)
               <td>
                  {{ $pie }}<br />
                  <input type="checkbox" data-toggle="toggle" data-size="xs" data-onstyle="success" data-offstyle="secondary" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-ban'></i>">
               </td>
            @endforeach 
            </tr>
         </tbody>
      </table> --}}


   {{-- <form action="{{ route('darts.around.players.store') }}" method="POST">
      @csrf --}}

      <div class="card mb-2">

         <div class="card-header card_header p-2">
            AROUND the WORLD - 
            @if($players->count() > 1) MULTI @else INDIVIDUAL @endif 
            PLAYER GAME
            <span class="float-right">Game ID : {{ $game->id }}</span>
         </div>
         
         <div class="card-body card_body p-2">
            @foreach($players as $p)
               <div class="card mb-2">
                  <div class="card-header card_header_2 p-2" style="font-size: 20px">
                     {{ $players->get($loop->index)->first_name }}
                  </div>
                  <div class="card-body card_body p-2">
                     <table class="table table-sm table-bordered">
                        <tbody>
                           <tr>
                              @foreach($pies as $pie)
                                 <th width="4.75%" class="p-1 text-center" style="font-size: 20px">
                                    {{$pie}}
                                 </th>
                              @endforeach
                           </tr>
                           <tr>
                              @foreach($pies as $pie)
                                 <td class="text-center">
                                    <input
                                       type="checkbox"
                                       data-toggle="toggle"
                                       data-size="xs"
                                       data-onstyle="success"
                                       data-offstyle="secondary"
                                       data-on="<i class='fa fa-check'></i>"
                                       data-off="<i class='fa fa-ban'></i>"
                                    >
                                 </td>
                              @endforeach
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            @endforeach
         </div>
         
         <div class="card-footer p-1">
            At the moment, it is not possible to save the game in the system
            <span class="text-danger float-right">Make sure you delete the game from the main list when you are done.</span>
            {{-- @if($game->status != 'Completed')
               <a href="{{ route('darts.around.players.completed', $game->id) }}" class="btn btn-sm btn-outline-info float-right">
                  Mark Game As Completed
               </a>
            @endif --}}
            {{-- <button type="submit" class="btn btn-secondary">Save</button> --}}
{{--          </div>

      </div> --}}
   {{-- </form> --}}

@endsection

@section('scripts')
   <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endsection
